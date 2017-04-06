<?php
	class LocalresultController extends Controller
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
			$dir = $_GET['resultftp'];
			$task_id = $_GET['taskid'];
			$LOCAL_DIFF_PATH="/home/work/local_ecplatform/platform_common/result/$task_id/result_bak/diff";
			$LOCAL_SPEED_PATH="/home/work/local_ecplatform/platform_common/result/$task_id/result_bak/speed";
			$remote_dis_machine="cp6076";
			$result_ftp = dirname($dir)."/data";
			$r=array();
			$r['taskid']=$task_id;
			$r['resultftp']=$result_ftp;
			$record=EcLocalTaskList::model()->find('TASK_ID=:TASK_ID', array(':TASK_ID'=>$task_id));
			$r['newolddiff']=$record->newolddiff;
			$r['newdiff']=$record->newdiff;
			$r['olddiff']=$record->olddiff;
			
			$r['thread_num']=$record->thread_num;
			$r['memory']=$record->memory;
			$r['speed']=$record->speed;
			$r['Valgrind']=$record->Valgrind;
			$r['dir']=$record->RUN_RESULT;
			$ec_type=$record->EC_type;
			$r['ec_type']=$ec_type;
//-------------------for strategy
			if($ec_type==0)
			{
				$stategies_zw_newec1=$record->stategies_zw_newec1;
				$newec1_strategy=split(":",$stategies_zw_newec1);
				$r['newec1_strategy']=$newec1_strategy;
				$stategies_zw_oldec1=$record->stategies_zw_oldec1;
				$oldec1_strategy=split(":",$stategies_zw_oldec1);
				$r['oldec1_strategy']=$oldec1_strategy;
				if(($newec1_strategy[0]==0)&&($oldec1_strategy[0]==0))
				{
					$stategies_zw_newec2=$record->stategies_zw_newec2;
					$newec2_strategy=split(":",$stategies_zw_newec2);
					$r['newec2_strategy']=$newec2_strategy;
					$stategies_zw_oldec2=$record->stategies_zw_oldec2;
					$oldec2_strategy=split(":",$stategies_zw_oldec2);
					$r['oldec2_strategy']=$oldec2_strategy;
				}
			}
			if($ec_type==1)
			{
				$stategies_gjh_newec=$record->stategies_gjh_newec;
				$newec_strategy=split(":",$stategies_gjh_newec);
				$r['newec_strategy']=$newec_strategy;
				$stategies_gjh_oldec=$record->stategies_gjh_oldec;
				$oldec_strategy=split(":",$stategies_gjh_oldec);
				$r['oldec_strategy']=$oldec_strategy;
			}
//------------------------end strategy
			$newec= "wget -r -nH --preserve-permissions --level=0 --cut-dirs=9 ".dirname($dir)."/code/product_new/";
			$oldec= "wget -r -nH --preserve-permissions --level=0 --cut-dirs=9 ".dirname($dir)."/code/product_old/";
			$r['newec']=$newec;
			$r['oldec']=$oldec;
            $r['dir']="wget -r -nH --preserve-permissions --level=0 --cut-dirs=8 ".dirname($dir)."/data";
            $diff_ftp = "wget ".dirname($dir)."/data/common";
			$cov_ftp = "wget ".dirname($dir)."/data/covfile";
			
			$r['input_data']=$diff_ftp.'/common_input';
			if($record->newolddiff == 0 && $record->newdiff == 0 && $record->olddiff == 0)
			{
				$r['output_data_new']=$diff_ftp.'/common_output_new';
				$r['output_data_old']=$diff_ftp.'/common_output_old';
			}
			if($record->newolddiff == 1)
			{
				$r['output_data_new']=$diff_ftp.'/common_output_new';
				$r['output_data_old']=$diff_ftp.'/common_output_old';
				//$str =  explode(":",$result_ftp);
            	$cmd_diffid = "go $remote_dis_machine 'cat $LOCAL_DIFF_PATH/diff_id.newold'";
				
				$diffid=exec("$cmd_diffid");
            	$r['diffid_newold'] = $diffid;
			}
			if($record->newdiff == 1)
			{
				$r['output_data_new']=$diff_ftp.'/common_output_new';
                $r['output_data_new_2']=$diff_ftp.'/common_output_new_2';
				$cmd_diffid = "go $remote_dis_machine 'cat $LOCAL_DIFF_PATH/diff_id.new'";
				$diffid=exec("$cmd_diffid");
                $r['diffid_new'] = $diffid;
			}
			if($record->olddiff == 1)
            {
                $r['output_data_old']=$diff_ftp.'/common_output_old';
                $r['output_data_old_2']=$diff_ftp.'/common_output_old_2';
				$cmd_diffid = "go $remote_dis_machine 'cat $LOCAL_DIFF_PATH/diff_id.old'";
                $diffid=exec("$cmd_diffid");
	
                $r['diffid_old'] = $diffid;
            }
			$cov_file_path="/home/work/LibPP/Jenkens/".$task_id;
			$cmd_cov="mkdir -p $cov_file_path;cd $cov_file_path;rm test.cov*;wget $cov_ftp/test.cov;export COVFILE=$cov_file_path/test.cov && covsrc --html | grep tr | grep td | grep \"=\"";
			$cov_result=shell_exec($cmd_cov);
			$r['cov_result'] = str_replace("\n"," ",$cov_result);
			$cmd_cov="export COVFILE=$cov_file_path/test.cov && covsrc --html | grep tr | grep td | grep \"=\" | head -1";
			$summery_result=shell_exec($cmd_cov);
			$cmd_cov="export COVFILE=$cov_file_path/test.cov && covsrc --html | grep tr | grep td | grep \"=\" | tail -1";
			$summery_result=$summery_result.shell_exec($cmd_cov);
			$r['summery_result'] = str_replace("\n"," ",$summery_result);
			//performance--chineseec
			$local_path="/home/work/local_ecplatform/platform_common/result/$task_id/memory";
			if ($record->EC_type == 0)
			{
				
				$new_ec1_path="$local_path/new_ec1";
				$new_ec2_path="$local_path/new_ec2";
				$old_ec1_path="$local_path/old_ec1";
				$old_ec2_path="$local_path/old_ec2";
				$memoryftp1="http://pat.baidu.com/index.php?r=tools/memorystaticapi&memory_path=$new_ec1_path";
				$memoryftp2="http://pat.baidu.com/index.php?r=tools/memorystaticapi&memory_path=$new_ec2_path";
				$memoryftp3="http://pat.baidu.com/index.php?r=tools/memorystaticapi&memory_path=$old_ec1_path";
				$memoryftp4="http://pat.baidu.com/index.php?r=tools/memorystaticapi&memory_path=$old_ec2_path";
				$r['memoryftp1'] = $memoryftp1;
				$r['memoryftp3'] = $memoryftp3;
				if(($newec1_strategy[0]==0)&&($oldec1_strategy[0]==0))
				{
					$r['memoryftp2'] = $memoryftp2;
					$r['memoryftp4'] = $memoryftp4;
				}
				$cmd_speed1 = "go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.new.ec1'";
				$speed1=shell_exec("$cmd_speed1");
            	$r['speed1'] = $speed1;
				$cmd_speed3 = "go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.old.ec1'";
            	$speed3=shell_exec("$cmd_speed3");
            	$r['speed3'] = $speed3;
				if(($newec1_strategy[0]==0)&&($oldec1_strategy[0]==0))
				{
					$cmd_speed2 = "go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.new.ec2'";
					$speed2=shell_exec("$cmd_speed2");
					$r['speed2'] = $speed2;
					$cmd_speed4 = "go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.old.ec2'";
            		$speed4=shell_exec("$cmd_speed4");
            		$r['speed4'] = $speed4;
				}
			}//END performance--chineseec
			else if ($record->EC_type == 1)
			{
				
                $new_ec_path="$local_path/new";
                
                $old_ec_path="$local_path/old";
                
                $memoryftp1="http://pat.baidu.com/index.php?r=tools/memorystaticapi&memory_path=$new_ec_path";
                
                $memoryftp3="http://pat.baidu.com/index.php?r=tools/memorystaticapi&memory_path=$old_ec_path";
                
                $r['memoryftp1'] = $memoryftp1;
                
                $r['memoryftp3'] = $memoryftp3;
                
                $cmd_speed1 = "go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.new'";
                $speed1=shell_exec("$cmd_speed1");
                $r['speed1'] = $speed1;
                
                $cmd_speed3 = "go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.old'";
                $speed3=shell_exec("$cmd_speed3");
                $r['speed3'] = $speed3;
                
			}
			//END 性能
			$this->renderPartial('result', $r);	
		}	
		//性能测试
	/*	
		public function actionPerformance(){
			$task_id = $_GET['taskid'];
            $dir = $_GET['resultftp'];
            $task_id = $_GET['taskid'];
            //拼接结果文件ftp地址   
            $result_ftp = dirname($dir);
			$result_ftp = $result_ftp."/data";	
            $r=array();
            $r['taskid']=$task_id;
            $r['resultftp']=$result_ftp;
            $record=EcLocalTaskList::model()->find('TASK_ID=:TASK_ID', array(':TASK_ID'=>$task_id));
            $r['newolddiff']=$record->newolddiff;
            $r['newdiff']=$record->newdiff;
            $r['olddiff']=$record->newolddiff;
            $r['memory']=$record->memory;
            $r['speed']=$record->speed;
            $r['Valgrind']=$record->Valgrind;
			$memoryftp1=$result_ftp."/memory/memory.log.new.ec1";
			$memoryftp2=$result_ftp."/memory/memory.log.new.ec2";
			$memoryftp3=$result_ftp."/memory/memory.log.old.ec1";
			$memoryftp4=$result_ftp."/memory/memory.log.old.ec2";
			$r['memoryftp1'] = $memoryftp1;
			$r['memoryftp2'] = $memoryftp2;
			$r['memoryftp3'] = $memoryftp3;
			$r['memoryftp4'] = $memoryftp4;

			$cmd_speed1 = "wget $result_ftp/speed/speed.log.new.ec1 -O /home/work/ec_test_service/webroot/speed.log.new.ec1;cat speed.log.new.ec1";
			$speed1=shell_exec("$cmd_speed1");
            $r['speed1'] = $speed1;
			$cmd_speed2 = "wget $result_ftp/speed/speed.log.new.ec2 -O /home/work/ec_test_service/webroot/speed.log.new.ec2;cat speed.log.new.ec2";
            $speed2=shell_exec("$cmd_speed2");
            $r['speed2'] = $speed2;
			$cmd_speed3 = "wget $result_ftp/speed/speed.log.old.ec1 -O /home/work/ec_test_service/webroot/speed.log.old.ec1;cat speed.log.old.ec1";
            $speed3=shell_exec("$cmd_speed3");
            $r['speed3'] = $speed3;
			$cmd_speed4 = "wget $result_ftp/speed/speed.log.old.ec2 -O /home/work/ec_test_service/webroot/speed.log.old.ec2;cat speed.log.old.ec2";
            $speed4=shell_exec("$cmd_speed4");
            $r['speed4'] = $speed4;
			$speed=array("speed1"=>$speed1,"speed2"=>$speed2,"speed3"=>$speed3,"speed4"=>$speed4);
			$r['speedarray']=json_encode($speed);
            $this->renderPartial('performance', $r);
				
        }*/
		public function actionShowlocallog()
		{
			$r=array();
			$task_id = $_GET['taskid'];
			$record=EcLocalTaskList::model()->find('TASK_ID=:TASK_ID', array(':TASK_ID'=>$task_id));
			$r['ec_type']=$record->EC_type;
			$ftp=$record->RUN_RESULT;
			$ftp=dirname($ftp);
			$status=$record->STATUS;
			$r['status']=$status;
			$r['resultftp']=$ftp;
			$r['taskid']=$task_id;
			$r['id']=json_encode(array('taskid'=>$task_id));
			$this->renderPartial('locallog', $r);
		}
		public function actionLog() {
            $remote_dis_machine="cp6076";
        	$task_id = $_GET['taskid'];
           // $result_ftp = $result_ftp."/data";  
            $r=array();
            $r['taskid']=$task_id;
           // $r['Valgrind']=$record->Valgrind;
        	$command = "go $remote_dis_machine 'cd /home/work/local_ecplatform/remote_dis_machine_script/enviroment/log/platform_common; cat  $task_id.*;'";
            $log = shell_exec($command);
			$r['log'] = $log;
			$this->json($r);			
    	}
	}
?>
