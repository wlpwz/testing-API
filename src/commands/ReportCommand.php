<?php
/**
 * @file src/commands/ReportCommand.php
 * @author yanglingling01(com@baidu.com)
 * @date 2014/03/29 16:16:06
 * @brief report for platform
 *  
 **/

class ReportCommand extends ConsoleCommand{
    const MAX_RETRY = 5;

    public function actionGen(){
        $plats = Platform::model()->findAll();    

        $data = array();
        foreach($plats as $pval){
            $tmp = array();
            $tmp['pid'] = $pval->id;
            $tmp['uaq'] = $this->getUaqTest($pval->url); 
           // $tmp['safe'] = $this->getSafeTest($pval->url);

            $tmp['product'] = $this->getProductSummary($pval->id);
            $tmp['userlog'] = $this->getUserlogSummary($pval->id);
            $tmp['create_time'] = time();               

            $data[] = $tmp;
        }       
        $this->insertData($data, "platform_report");
    }


    protected function getUaqTest($url){
$url="http://zhanzhang.baidu.com/";
        //uaq检测
        $job = Yii::app()->uaq->start($url);
        if(!$job) return false;
        
        $result = array();
        $retry = 0;
        while(!$result && $retry<=self::MAX_RETRY){
            $uaq = Yii::app()->uaq->result($job, true);
            if($uaq){   
                $uaqArray = json_decode($uaq, true);
                if(!$uaqArray) continue;
    
                $temp['PageSpeedScore'] = $uaqArray['data']['ispData']['ct']['firstView']['basic']['PageSpeedScore'];
                $temp['firstScreen'] = $uaqArray['data']['ispData']['ct']['firstView']['basic']['firstScreen'];
                $temp['gzip'] = $uaqArray['data']['ispData']['ct']['firstView']['optimization']['gzip']['score'];
                $temp['compress'] = $uaqArray['data']['ispData']['ct']['firstView']['optimization']['compress']['score']; 
                $temp['browser_name'] = $uaqArray['data']['ispData']['ct']['firstView']['basic']['browser_name'];
                $result['data'][] = $temp;
                $result['score'] = $temp['PageSpeedScore'];
            }
                       
            sleep(10);
            $retry ++;
        }       

        return json_encode($result); 
    }

    protected function getSafeTest($url){
        //扫雷检测
            
    }

    protected function getProductSummary($pid){
        $crit = array();
        $crit['condition'] = " `pid`=:pid ";
        $crit['params'] = array(":pid" => $pid);
        $dbConf = ConfigMondb::model()->findAll($crit); 
  

        $result = array('score' => 0, 'data' => []); 
        $avgScore  = 0;
        $count = 0; 
        foreach($dbConf as $dval){
           $type = $dval->name."_weekly";
           $tObj = CountType::model()->findByAttributes(array('type' => $type));
           $name = $dval->cname;   
         
           $c = array();
           $c['condition'] = " `tid`=:tid order by ctime desc limit 2";
           $c['params'] = array(":tid" => $tObj->id);
           $data = CountData::model()->findAll($c);

           $countData = array();
           foreach($data as $dval){
                $date = date("Y-m-d", $dval->ctime);
                $countData[$date] = $dval->count;
           }
           ksort($countData);
           $last = array_shift($countData);
           $current = array_pop($countData);
           $delta = $current - $last;
            
           $tmp = array();
           $tmp['name']  = $name;
           $tmp['current'] = $current;
           $tmp['last'] = $last;
           $tmp['delta'] = $delta;
        
           //分数评估
           $deltaScore = ($last==0)?0:round(($delta/$last)*70, 2);
           $tmp['score'] = 65 + $deltaScore;
           $avgScore += $tmp['score'];
           $count ++;
           $result['data'][] = $tmp;
        }
        $result['score'] = $count==0?0:(round($avgScore/$count, 2));
        return json_encode($result);
    } 


    protected function getUserlogSummary($pid){
        $result = array('data' => array(), 'score' => 0);
        $crit = array();
        $crit['condition'] = " `pid`=:pid ";
        $crit['params'] = array(":pid" => $pid);                

        $config = ConfigUserlog::model()->find($crit);   
        $citem = ConfigUserlogItems::model()->findByAttributes(array("cid" => $config->id));
                
        $c = array();
        $c['condition'] = " `cid`=:cid order by ctime desc limit 2";
        $c['params'] = array(":cid" => $citem->id);
        $data = UserlogSummaryWeekly::model()->findAll($c);

        $countData = array();
        foreach($data as $dval){ 
            $date = date("Y-m-d", $dval->ctime);
            $countData[$date]['pv'] = $dval->pv;
            $countData[$date]['new_uv'] = $dval->new_uv;
            $countData[$date]['all_uv'] = $dval->all_uv;
        }  
        if(count($countData)<2) return json_encode($result);
     
        ksort($countData);
        $current = array_pop($countData);
        $last = array_shift($countData);       

        $count = 0;
        foreach($current as $key => $number){
            $tmp = array();
            $tmp['name']  = $this->getName($key);
            $tmp['current'] = $number;
            $tmp['last'] = $last[$key];

            $delta = $tmp['current'] - $tmp['last'];
            $tmp['delta'] = $delta; 
            $tmp['score'] = 65 + round(($delta/$tmp['last'])*70, 2);
            $avgScore += $tmp['score'];
            $count ++;
            $result['data'][] = $tmp;
        }
        $result['score'] = $count==0?0:(round($avgScore/$count, 2));
        return json_encode($result);
    }

    public function getName($key){
        $describe = array();
        $describe['pv'] = "浏览量PV（日均）";
        $describe['new_uv'] = "新增访客量UV";
        $describe['all_uv'] = "访客量UV";

        $res = isset($describe[$key])?$describe[$key]:"未知";
        return $res;
    }


}
