<?php
class DatasafeController extends Controller
{
	//config path
    public $layout = "datasafe";
    public function actions()
    {      
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName            'page'=>array(
           'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

	public function filters()
    {
        return array('popLog');
    }
    public function filterPopLog(CFilterChain $chain){
    $username = Yii::app()->user->name; //获取登录用户，注意结合项目实际获取方式更改
    $url = $chain->controller->id."/".$chain->action->id;
    POP::log("page", $url, $username);
    $chain->run();
    }
    public function actionIndex(){
        $data = array();
        $data['flag1']=true;
        $this->render('index',$data);
    }       
	public function actionSubmit($data_version_id='',$flag=1){
        $date_flag=date("ymdH").'-'.rand(1,99);
	    $data = array();
        $data['safe_data'] = array();
        $data['safe_data2'] = array();
        $data['data_id'] = array();
        if($flag == 1){
            $DC_DICT_MACHINE="work@cq7220";
            $DC_DICT_SCRIPT="/home/work/yyh/";
            #$data_version_id="valid-del-validcover_1434595922";
            //select data_id from safe_data where data_version_id like "%data_version_id%"
            $safe_data = Safedata::model()->findAll(array("condition" => " data_version_id like'%{$data_version_id}%' order by data_id desc limit 10"));
            $data['data_id'] = $safe_data;
            if(!empty($data['data_id'])){
                foreach ($data['data_id'] as $task){
                    $data_id = $task['data_id'];
                    $cmd = "~/ci/lib/baselib/bin/go $DC_DICT_MACHINE 'cd $DC_DICT_SCRIPT;nohup sh bogus_log_check.sh $data_id &'";
                    $res = shell_exec($cmd);
                    $data['safe_data'][$i]['status'] = $res;
                    $data['safe_data'][$i]['data_version_id'] = $task['data_version_id'];
                    $data['safe_data'][$i]['data_id'] = $task['data_id'];
                    $data['safe_data'][$i]['data_version_time'] = $task['data_version_time'];
                    $i++;
                }
            }
        }elseif($flag == 2){
            $DATASAFE_MACHINE="work@cq7220";
            $DATASAFE_SCRIPT="/home/work/yyh";
            $FILE_NAME="pat_lbbl_status";
            #$data_version_id="valid-del-validcover";
            $cmd = "~/ci/lib/baselib/bin/go $DATASAFE_MACHINE 'source .bash_profile; cd $DATASAFE_SCRIPT;nohup python Pat_lbbl_status.py $data_version_id &>./patlog/pat_lbbl_status&'";
            exec($cmd);
            sleep(10);
            $file_path="ftp://cq01-testing-ps7220.cq01.baidu.com$DATASAFE_SCRIPT/$FILE_NAME";
            $cmd_file="mkdir -p ~/data-safe;cd ~/data-safe;wget -r -nH --preserve-permissions --level=0 --cut-dirs=4 $file_path";
            exec($cmd_file);
            $file_tmp = trim(shell_exec("cat /home/work/data-safe/$FILE_NAME"));
            $i=0;
            if(!empty($file_tmp)){
                foreach (explode("\n", $file_tmp) as $item){
                    $data['safe_data2'][$i][data_version_id] = explode(";", $item)[0];
                    $data['safe_data2'][$i][data_id] = explode(";", $item)[1];
                    $data['safe_data2'][$i][data_version_time]=explode(";",$item)[2];
                    $data['safe_data2'][$i][data_version_key]=explode(";",$item)[3];
                    $data['safe_data2'][$i][data_onset_vars]=explode(";",$item)[4];
                    $data['safe_data2'][$i][data_cmd]=explode(";",$item)[5];
                    $i++;
                }
            }
        }
        $this->render('index',$data);
    }

	public function actionLbstatAPI(){
	    $data_version_id = $_GET['data_version_id'];
        $data = array();
        $data['safe_data'] = array();
        $data['data_id'] = array();
        $DC_DICT_MACHINE="work@cq7220";
        $DC_DICT_SCRIPT="/home/work/yyh/";
        #$data_version_id="valid-del-validcover_1434595922";
        //select data_id from safe_data where data_version_id like "%data_version_id%"
        $safe_data = Safedata::model()->findAll(array("condition" => " data_version_id like'%{$data_version_id}%' order by data_id desc limit 1"));
        $data['data_id'] = $safe_data;
        if(!empty($data['data_id'])){
            foreach ($data['data_id'] as $task){
                $data_id = $task['data_id'];
                $cmd="~/ci/lib/baselib/bin/go $DC_DICT_MACHINE 'cd $DC_DICT_SCRIPT;nohup sh bogus_log_check.sh $data_id &'";
                $res = shell_exec($cmd);
                echo $res;    
            }
        }
    }
    public function actionTools(){
       $data['check_result'] = array();
       $this->render('tools',$data); 
    }
    public function actionToolsbogus(){
       $data['bogus_result'] = array();
       $this->render('toolsbogus',$data);
    }
    public function actionSubmit1($flag1=0,$flag2=0,$ftp_url="",$hdfs_url="",$hdfs_user="",$hdfs_pass="",$ftp_number=0,$hdfs_number=0){
        $date_flag=date("ymdH").'-'.rand(1,99);
        $HADOOP_PATH="/home/work/hadoop-client/hadoop/bin/hadoop";
        $HADOOP_FS="$HADOOP_PATH fs";
        $DATA_SAFE="/home/work/data-safe";
        $FILEH_NAME="hadoop.txt";
        $FILEF_NAME="ftp.txt";
        $data['check_result'] = array();
        $count=0;
        if($ftp_url != ""){
            foreach (explode("/",$ftp_url) as $item){
                $count=$count+1;
            }
            $path_num=$count-4;
            
            $cmd="cd $DATA_SAFE; wget -r -nH --preserve-permissions --level=0 --cut-dirs=$path_num $ftp_url -O $FILEF_NAME";
            exec($cmd);
            if(is_file("$DATA_SAFE/$FILEF_NAME")){
                $data['check_result'][0]['check_path'] = "ftp地址校验通过，文件存在";
                $data['check_result'][0]['path'] = $ftp_url;
            }else{
                $data['check_result'][0]['check_path'] = "ftp地址校验失败，文件不存在";
                $data['check_result'][0]['path'] = $ftp_url;
            }
            $i=0;
            if($ftp_number > 0){
                $result=shell_exec("cat $DATA_SAFE/$FILEF_NAME");
                foreach (explode(" ",$result) as $item){
                  $i=$i+1;
                }
                $number=$i;
                if($number != intval($ftp_number)){
                    $data['check_result'][0]['check_path'] = "ftp schema校验不通过，请确认是否空格分隔";
                    $data['check_result'][0]['path'] = $ftp_url;
                }else{
                    $data['check_result'][0]['check_path'] = "ftp schema校验通过";
                    $data['check_result'][0]['path'] = $ftp_url;
                }
            }
        }
        if($hdfs_url != ""){
            explode("/", $hdfs_url)[0];
            explode("/", $hdfs_url)[1];
            explode("/", $hdfs_url)[2];
            $ftp_path = explode("/", $hdfs_url)[0] . "/" .explode("/",$hdfs_url)[1]."/" .explode("/",$hdfs_url)[2];
			$hdfs_url1=str_replace("*","",$hdfs_url);
            $cmd = "$HADOOP_FS -D hadoop.job.ugi='$hdfs_user,$hdfs_pass' -D fs.default.name=$ftp_path -dus $hdfs_url1|awk '{print $2}'";
            $count = exec($cmd);
            if($count > 0){
                $data['check_result'][1]['check_path'] = "hdfs地址校验通过，文件存在";
                $data['check_result'][1]['path'] = $hdfs_url;
            }else{
                $data['check_result'][1]['check_path'] = "hdfs地址校验失败，文件不存在";
                $data['check_result'][1]['path'] = $hdfs_url;
            }
            $j=0;
            if($hdfs_number!=0){
                $result=shell_exec("cat $DATA_SAFE_PATH/$FILEF_NAME");
                foreach (explode(" ",$ftp_path) as $item){
                    $j=$j+1;
                }
                if($j != intval($hdfs_number)){
                    $data['check_result'][1]['check_path'] = "hdfs schema校验不通过，请确认是否空格分隔";
                    $data['check_result'][1]['path'] = $hdfs_url;
                }else{ 
                    $data['check_result'][1]['check_path'] = "hdfs schema校验通过";
                    $data['check_result'][1]['path'] = $hdfs_url;
                }
            }
        }
        $this->render('tools',$data);
    }
    public function actionSubmit2($bogus_vars=""){
        $data = array();
        $data['bogus_result'] = array();
        $DATASAFE_MACHINE = "work@cq7220";
        $DATASAFE_SCRIPT = "/home/work/yyh";
        $FILE_NAME = "pat_bogus_data";
        $DATA_SAFE = "/home/work/data-safe";
        #$data_version_id="valid-del-validcover";
        $cmd = "~/ci/lib/baselib/bin/go $DATASAFE_MACHINE 'source .bash_profile; cd $DATASAFE_SCRIPT;nohup sh Check_emitter_input.sh $bogus_vars >./patlog/$FILE_NAME&'";
        exec($cmd);
        $file_path = "ftp://cq01-testing-ps7220.cq01.baidu.com$DATASAFE_SCRIPT/patlog/$FILE_NAME";
        $cmd_file = "mkdir -p ~/data-safe;cd ~/data-safe;wget -r -nH --preserve-permissions --level=0 --cut-dirs=4 $file_path";
        exec($cmd_file);
        var_dump($bogus_vars);
        if(is_file("$DATA_SAFE/$FILE_NAME")){
            $file_count = trim(shell_exec("cat $DATA_SAFE/$FILE_NAME |wc -l"));
            if($file_count >0){
                $result = trim(shell_exec("cat $DATA_SAFE/$FILE_NAME"));
                $data['bogus_result'][0]['bogus_vars'] = $bogus_vars;
                $data['bogus_result'][0]['result'] = $result;
            }else{
                $data['bogus_result'][0]['bogus_vars'] = $bogus_vars;
                $data['bogus_result'][0]['result'] = "统一回灌命令正确";
            }
        }
        $this->render('toolsbogus',$data);
    }
    public function actionBogus(){
	   $dataresult = array();
       $data['safedata'] = array();
       $dataresult['result_status'] = array();
       $dataresult['check_status'] = array();
       $dataresult['bogus_status'] = array();
	   $conf_name="valid-del-longgarbage";
       $conf = Safeconf::model()->findAll(array("condition" => " conf_name like'%{$conf_name}%'"));
	   if(!empty($conf)){
		   //conf_id for circle
		   $i = 0;
		   $j = 0;
		   $flag = 0;
		   $k = 0;
		   foreach($conf as $item){
			   $conf_id = $item['conf_id'];
			   //var_dump($conf_id);
			   $conf = Safeconf::model()->findByPk($conf_id);
               $safedata = $conf->datasafe;
			   $safeonset = $conf->onset;
               //safe_conf data--first table
			   $dataresult['result_status'][$i]['conf_name'] = $item['conf_name'];
			   $dataresult['result_status'][$i]['conf_lasted_update_time'] = $item['conf_lasted_update_time'];
			   if($item['conf_approve_status'] == 'pending' or $item['conf_approve_status'] == 'ajust'){
				   $dataresult['result_status'][$i]['status'] = 1;
			   }elseif($item['conf_approve_status'] == 'complete'){
				   $dataresult['result_status'][$i]['status'] = 2;
			   }elseif($item['conf_runflag'] == 1){
				   $dataresult['result_status'][$i]['status'] = 3;
			   }
			   $dataresult['result_status'][$i]['onset_type'] = $safeonset['onset_type'];
			   $dataresult['result_status'][$i]['conf_env'] = $item['conf_env'];
			   $flag = 1;
			   //onset colume has-one
			   //var_dump($safeonset['onset_type']);
			   //safe_data colume has-manay
               $data['safedata'] = $safedata;
	           if(!empty($data['safedata'])){
		           foreach ($data['safedata'] as $task){
					   if($flag == 1){//first table
						   //$status = $task['data_status']+3;
						   if($task['data_status'] <= 6 and $task['data_lb_status'] == 0){
							   $status = $task['data_status'] + 3;
						   }else{
							   $status = $task['data_lb_status'] + 11;
						   }
						   $dataresult['result_status'][$i]['status'] = $status;//first table
						   $dataresult['result_status'][$i]['data_id'] = $task['data_id'];//first table
					   }
					   //second table
					   $dataresult['check_status'][$j]['conf_name'] = $dataresult['result_status'][$i]['conf_name'];
					   $dataresult['check_status'][$j]['data_id'] = $task['data_id'];
					   $dataresult['check_status'][$j]['data_version_time'] = $task['data_version_time'];
					   $dataresult['check_status'][$j]['data_status'] = $task['data_status'];
					   $dataresult['check_status'][$j]['data_callback_valid_msg'] = $task['data_callback_valid_msg'];
					   if($task['data_status']==8){
						   $dataresult['check_status'][$j]['data_tobogus'] = 1;//send data to bogus
					   }else{
						   $dataresult['check_status'][$j]['data_tobogus'] = 0;//dont't send data to bogus
					   }
					   //third table
					   if($task['data_status'] > 6 and $safeonset['onset_type'] == 3){
						   $dataresult['bogus_status'][$k]['conf_name'] = $dataresult['result_status'][$i]['conf_name'];
						   $dataresult['bogus_status'][$k]['data_id'] = $task['data_id'];
						   if($task['data_status'] == 7 and $task['data_lb_status'] == 0){
							   $dataresult['bogus_status'][$k]['data_lb_status'] = 3;
						   }else{
							   $dataresult['bogus_status'][$k]['data_lb_status']=$task['data_lb_status'];
						   }
						   $dataresult['bogus_status'][$k]['onset_vars'] = $safeonset['onset_vars'];
						   $dataresult['bogus_status'][$k]['data_lines']=$task['data_lines'];
						   $dataresult['bogus_status'][$k]['data_bogus_lb_status']=$task['data_bogus_lb_status'];
						   $dataresult['bogus_status'][$k]['data_bogus_bl_status']=$task['data_bogus_bl_status'];
						   $k = $k+1;
					   }
					   $j = $j+1; 
					   $flag = 0;
		           }
			   }
			   $i = $i+1;
			   $k = $i;
		   }
	   }
#var_dump($dataresult['bogus_status']); 
       //var_dump($dataresult['result_status']); 
       $this->render('bogus',$dataresult); 
    }

}#CLASS
?>
