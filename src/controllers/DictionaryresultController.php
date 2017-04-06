<?php
	class DictionaryresultController extends Controller
	{
		public $layout = "main";
		//
		public function filters()
    	{
        	return array('popLog');
    	}
    	public function filterPopLog(CFilterChain $chain){
    		$username = Yii::app()->user->name; 
    		$url = $chain->controller->id."/".$chain->action->id;
    		POP::log("page", $url, $username);
    		$chain->run();
    	}       
		public function actionResult(){
//			$dir = $_GET['resultftp'];
			$task_id = $_GET['taskid'];
			$LOCAL_DIFF_PATH="/home/spider/platform_dc/result/$task_id/diff";
			$LOCAL_SPEED_PATH="/home/spider/platform_dc/result/$task_id/speed";
			$remote_dis_machine="spider@cq7210";
			$result_ftp = dirname($dir)."/data";
			$r=array();
			$r['taskid']=$task_id;
			$r['resultftp']=$result_ftp;
			$record=dictionary::model()->find('id=:id', array(':id'=>$task_id));
			$dir=$record->result;
			$r['dir']=$record->result;
			$dc_type=$record->language;
			$r['dc_type']=$dc_type;
			$newold=$record->newold;
			$r['newold']=$newold;
			$memory=$record->memory;
			$r['memory']=$memory;
			$speed=$record->speed;
			$r['speed']=$speed;
			$r['dictionary_name']=$record->dictionary_name;
			$source=$record->source;
			$source=explode(":",$source);
			$r['source_name']=$source[0];
			for($i=1;$i<count($source);$i++)
				$r['source_ftp'] .= ":" . $source[$i];
			//$newec= "wget -r -nH --preserve-permissions --level=0 --cut-dirs=9 ".dirname($dir)."/platform_common/$task_id/code/product_new/";
			$newec= "wget -r -nH --preserve-permissions --level=0 --cut-dirs=9 ".dirname($dir)."code/product_new/";
			$oldec= "wget -r -nH --preserve-permissions --level=0 --cut-dirs=9 ".dirname($dir)."/code/product_old/";
			$r['newec']=$newec;
			$r['oldec']=$oldec;
            $r['dir']="wget -r -nH --preserve-permissions --level=0 --cut-dirs=8 ".$r['dir']."";
            $diff_ftp = "wget -r -nH --preserve-permissions --level=0 --cut-dirs=10 ".dirname($dir);
			$cov_ftp = "wget ".dirname($dir)."/data/covfile";
			
			$r['input_data']='wget ftp://cq01-testing-ps7210.cq01.baidu.com:/home/spider/platform_dc/data/zhongwen/memory_speed_input';
/***************************newolddiff*******************************/
			if($newold==1){
				$r['output_data_new']=$diff_ftp."/data/memory/trap_out_new";
				$r['output_data_old']=$diff_ftp."/data/memory/trap_out_old";
				//$str =  explode(":",$result_ftp);
            	$cmd_diffid = "~/ci/lib/baselib/bin/go $remote_dis_machine 'cat $LOCAL_DIFF_PATH/diff_id.newold'";
				$cmd_saverdiffid = "~/ci/lib/baselib/bin/go $remote_dis_machine 'cat $LOCAL_DIFF_PATH/diff_id_saver.newold'";
				$diffid=exec("$cmd_diffid");
				$diffsaverid=exec("$cmd_saverdiffid");
				$diffrecord = DcDiffTaskList::model()->find('diff_task_id=:diff_task_id', array(':diff_task_id'=>$diffid));
				$time = $diffrecord->time;
				$time = substr($time,0,10);
				$r['time'] = $time;
            	$r['diffid_newold'] = $diffid;
				$r['saver_diffid'] = $diffsaverid;
			}
/*******************end newolddiff**********************************************/
			//$cov_file_path="/home/work/LibPP/Jenkens/".$task_id;
			//$cmd_cov="mkdir -p $cov_file_path;cd $cov_file_path;rm test.cov*;wget $cov_ftp/test.cov;export COVFILE=$cov_file_path/test.cov && covsrc --html | grep tr | grep td | grep \"=\"";
			//$cov_result=shell_exec($cmd_cov);
			//$r['cov_result'] = str_replace("\n"," ",$cov_result);
			//$cmd_cov="export COVFILE=$cov_file_path/test.cov && covsrc --html | grep tr | grep td | grep \"=\" | head -1";
			//$summery_result=shell_exec($cmd_cov);
			//$cmd_cov="export COVFILE=$cov_file_path/test.cov && covsrc --html | grep tr | grep td | grep \"=\" | tail -1";
			//$summery_result=$summery_result.shell_exec($cmd_cov);
			//$r['summery_result'] = str_replace("\n"," ",$summery_result);
			//performance--chineseec
			$local_path="/home/spider/platform_dc/result/$task_id/memory";
			if ($record->language == 0)
			{
				$new_DC_path="$local_path/memory_new";
				$old_DC_path="$local_path/memory_old";
				//var_dump($new_DC_path); exit;
				if ($memory == 1)
				{
					$memoryftp1="http://pat.baidu.com/index.php?r=tools/memoryDc&memory_path=$new_DC_path";
					$memoryftp3="http://pat.baidu.com/index.php?r=tools/memoryDc&memory_path=$old_DC_path";
					$r['memoryftp1'] = $memoryftp1;
					$r['memoryftp3'] = $memoryftp3;
				}
				if ($speed == 1)
				{
					$cmd_speed1 = "~/ci/lib/baselib/bin/go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.new'";
					$speed1=shell_exec("$cmd_speed1");
            		$r['speed1'] = $speed1;
					//var_dump($speed1); exit;
					$cmd_speed3 = "~/ci/lib/baselib/bin/go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.old'";
            		$speed3=shell_exec("$cmd_speed3");
            		$r['speed3'] = $speed3;
				}
			}//END performance--chineseec
			else if ($record->language == 1)
			{
				if($memory==1)
				{	
                	$new_ec_path="$local_path/memory_new";
                
               	 	$old_ec_path="$local_path/memory_old";
                
                	$memoryftp1="http://pat.baidu.com/index.php?r=tools/memorystaticapi&memory_path=$new_ec_path";
                
                	$memoryftp3="http://pat.baidu.com/index.php?r=tools/memorystaticapi&memory_path=$old_ec_path";
                
                	$r['memoryftp1'] = $memoryftp1;
                
                	$r['memoryftp3'] = $memoryftp3;
                }
				if ($speed ==1)
				{
                	$cmd_speed1 = "go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.new'";
                	$speed1=shell_exec("$cmd_speed1");
                	$r['speed1'] = $speed1;
                
                	$cmd_speed3 = "go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.old'";
                	$speed3=shell_exec("$cmd_speed3");
                	$r['speed3'] = $speed3;
                }
			}
			//END 性能
			$this->renderPartial('result', $r);	
		}	
/*************************DIFF RESULT***************************************/
		public function actionDiffresultshow()
		{
			$diff_id = $GET['diffid'];
			if($diff_id!="")
        	{       
            	$diff_num=1;
            	$diff_id_two[0]=$diff_id;
        	}       
        	else    
        	{       
            	$diff_num=0;
        	}       
		}
/*************************LOG SHOW******************************************/		
		public function actionShowlog()
		{
			$r=array();
			$task_id = $_GET['taskid'];
		//	$record=EcLocalTaskList::model()->find('TASK_ID=:TASK_ID', array(':TASK_ID'=>$task_id));
		//	$r['ec_type']=$record->EC_type;
		//	$ftp=$record->RUN_RESULT;
		//	$ftp=dirname($ftp);
		//	$status=$record->STATUS;
		//	$r['status']=$status;
		//	$r['resultftp']=$ftp;
			$r['taskid']=$task_id;
			$r['id']=json_encode(array('taskid'=>$task_id));
			$this->renderPartial('dictionarylog', $r);
		}
		public function actionLog() {
            $remote_dis_machine="cq7210";
        	$task_id = $_GET['taskid'];
           // $result_ftp = $result_ftp."/data";  
            $r=array();
            $r['taskid']=$task_id;
           // $r['Valgrind']=$record->Valgrind;
        	$command = "~/ci/lib/baselib/bin/go spider@$remote_dis_machine 'cd /home/spider/platform_dc/log; cat  $task_id;'";
			
            $log = shell_exec($command);
			
			$r['log'] = $log;
			$this->json($r);			
    	}
	}
?>
