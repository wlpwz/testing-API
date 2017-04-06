<?php
	class JenkinsresultController extends Controller
	{
		public $layout = "main";
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
		private function transferOptions($label_x,$label_y_unit,$label_y_precision){
			$result[ChartTPL::$CHART_OPTION_LABEL_X]=$label_x;
			$result[ChartTPL::$CHART_OPTION_LABEL_Y_UNIT]=$label_y_unit;
			$result[ChartTPL::$CHART_OPTION_LABEL_Y_PRECISION]=$label_y_precision;
			return $result;
		}
		private function transferGetData($data){
			$data_array=explode(";",$data);
			$result=array();
			foreach ($data_array as $value) {
				$temp_array=explode(",", $value);
				$temp_key=$temp_array[0];
				$temp_sub_array=array_slice($temp_array,1);
				$temp_value=implode(",", $temp_sub_array);
				$result[$temp_key]=$temp_value;
			}
			return $result;
		}
		public function actionMemoryAPI()
		{
			$this->layout='//layouts/blank';
			$file = $_GET["file_path"];
			$fp = fopen($file, "r");
			$model1_string="RSS";
			$model2_string="VSS";
			$label_x="";
			$line_count=0;
			$max_x=20;
			while (!feof($fp))
			{
				$string=fgets($fp,4096);
				$str = str_replace(PHP_EOL, '', $string);
				$m_array = split(" ",$str);
				if (count($m_array) > 1)
				{
					$model1_string=$model1_string.",".$m_array[0];
					$model2_string=$model2_string.",".$m_array[1];
				}
				$line_count++;
			}
			$data = $model1_string.";".$model2_string;
			$result_data = $this->transferGetData($data);
			if ($line_count <= $max_x)
			  $max_x = $line_count;
			$interval = $line_count / $max_x;
			for ($i=0;$i<$max_x;$i++)
			{
				$num=$interval * $i;
				$label_x = $label_x.strval($num).",";
			}
			$label_y = "Mb";
			$options=$this->transferOptions($label_x,$label_y,"");	
			$chart_id=ChartFactory::CONST_CHART_TYPE_LINE_BAR_BASIC."_".md5(rand());
			$height=500;
			$this->render('apichart',array(
				"data"=>$result_data,
				"options"=>$options,
				"height"=>$height,
				'chart_type'=>ChartFactory::CONST_CHART_TYPE_LINE_BAR_BASIC,
				'chart_id'=>$chart_id,
			));
		}
		public function actionResult(){
			$dir = $_GET['resultftp'];
			$task_id = $_GET['taskid'];
			$LOCAL_DIFF_PATH="/home/work/local_ecplatform/jekens/result/$task_id/result_bak/diff";
			$LOCAL_SPEED_PATH="/home/work/local_ecplatform/jekens/result/$task_id/result_bak/speed";
			$LOCAL_COV_PATH="/home/work/local_ecplatform/jekens/result/$task_id/result_bak/covfile/";
			$LOCAL_BIGPACK_PATH="/home/work/local_ecplatform/jekens/result/$task_id/result_bak/bigpack/";
			$remote_dis_machine="cp6076";
			$r['taskid']=$task_id;
			$record=EcJenkinsTaskList::model()->find('TASK_ID=:TASK_ID', array(':TASK_ID'=>$task_id));
			$r['dir']=$record->RUN_RESULT;
			$ec_type=$record->EC_type;
			$thread_num=$record->thread_num;
			$newolddiff=$record->newolddiff;
			$newdiff=$record->newdiff;
			$olddiff=$record->olddiff;
			$memory = $record->memory;
			$speed = $record->speed;
			$Valgrind = $record->Valgrind;
			$r['thread_num']=$thread_num;
			$r['newolddiff']=$newolddiff;
			$r['newdiff']=$newdiff;
			$r['olddiff']=$olddiff;
			$r['memory']=$memory;
			$r['speed']=$speed;
			$r['Valgrind']=$Valgrind;
			$r['ec_type']=$ec_type;
			$newec= "wget -r -nH --preserve-permissions --level=0 --cut-dirs=9 ".dirname($dir)."/code/product_new/";
			$oldec= "wget -r -nH --preserve-permissions --level=0 --cut-dirs=9 ".dirname($dir)."/code/product_old/";
			$r['newec']=$newec;
			$r['oldec']=$oldec;
            $r['dir']="wget -r -nH --preserve-permissions --level=0 --cut-dirs=8 ".dirname($dir)."/data";
			$diff_ftp = "wget ".dirname($dir)."/data/common";
			$cov_ftp  = "wget ".dirname($dir)."/data/covfile";
			$r['input_data']=$diff_ftp.'/common_input';
//--------------------a
				$r['output_data_new_a']=$diff_ftp.'/common_output_new';
				$r['output_data_old_a']=$diff_ftp.'/common_output_old';
            	$cmd_diffid = "go $remote_dis_machine 'cat $LOCAL_DIFF_PATH/diff_id.newold'";
				$diffid=exec("$cmd_diffid");
            	$r['diffid_newold'] = $diffid;
//--------------------b
				$r['output_data_new_b']=$diff_ftp.'/common_output_new';
                $r['output_data_new_2_b']=$diff_ftp.'/common_output_new_2';
                $cmd_diffid = "go $remote_dis_machine 'cat $LOCAL_DIFF_PATH/diff_id.new'";
				$diffid=exec("$cmd_diffid");
                $r['diffid_new'] = $diffid;
//--------------------c
                $r['output_data_old_c']=$diff_ftp.'/common_output_old';
                $r['output_data_old_2_c']=$diff_ftp.'/common_output_old_2';
				$cmd_diffid = "go $remote_dis_machine 'cat $LOCAL_DIFF_PATH/diff_id.old'";
                $diffid=exec("$cmd_diffid");
                $r['diffid_old'] = $diffid;
//-----------------------END-DIFF--------------------------				
//=======================COV------------------------------
			$cmd_cov="go $remote_dis_machine 'cd $LOCAL_COV_PATH;export COVFILE=$LOCAL_COV_PATH/test.cov && /home/work/safe/bin/covsrc --html | grep tr | grep td | grep \"=\"'";
			$cov_result=shell_exec($cmd_cov);
			
			$r['cov_result'] = str_replace("\n"," ",$cov_result);
			$cmd_cov="go $remote_dis_machine 'export COVFILE=$LOCAL_COV_PATH/test.cov && /home/work/safe/bin/covsrc --html | grep tr | grep td | grep \"=\" | head -1'";
			$summery_result=shell_exec($cmd_cov);
			
			$cmd_cov="go $remote_dis_machine 'export COVFILE=$LOCAL_COV_PATH/test.cov && /home/work/safe/bin/covsrc --html | grep tr | grep td | grep \"=\" | tail -1'";
			$summery_result=$summery_result.shell_exec($cmd_cov);
			$r['summery_result'] = str_replace("\n"," ",$summery_result);
//--------------------performance
			$result_ftp=dirname($dir).'/data';

			$cmd_bigpack="cat $LOCAL_BIGPACK_PATH/bigpack_ec1.picture";
			$r['bigpack_ec1']=shell_exec($cmd_bigpack);
			$cmd_bigpack="cat $LOCAL_BIGPACK_PATH/bigpack_ec2.picture";
			$r['bigpack_ec2']=shell_exec($cmd_bigpack);
			$cmd_bigpack="cat $LOCAL_BIGPACK_PATH/bigpack_ec1.timelist";
			$temp_string=shell_exec($cmd_bigpack);
			$bigpack_ec1_list="";
			$array_line=split("\n",$temp_string);
			for($i=0;$i<count($array_line);$i++)
			{
				$bigpack_ec1_list=$bigpack_ec1_list."<tr><td>".strval($i+1)."</td>";
				$array_row=split("\t",$array_line[$i]);
				for ($j=0; $j < count($array_row); $j++)
				{
					$bigpack_ec1_list=$bigpack_ec1_list."<td>".$array_row[$j]."</td>";
				}
				$bigpack_ec1_list=$bigpack_ec1_list."</tr>";
			}
			$r['bigpack_ec1_list']=$bigpack_ec1_list;
			$cmd_bigpack="cat $LOCAL_BIGPACK_PATH/bigpack_ec2.timelist";
			$temp_string=shell_exec($cmd_bigpack);
			$bigpack_ec2_list="";
			$array_line=split("\n",$temp_string);
			for($i=0;$i<count($array_line);$i++)
			{
				$bigpack_ec2_list=$bigpack_ec2_list."<tr><td>".strval($i+1)."</td>";
				$array_row=split("\t",$array_line[$i]);
				for ($j=0; $j < count($array_row); $j++)
				{
					$bigpack_ec2_list=$bigpack_ec2_list."<td>".$array_row[$j]."</td>";
				}
				$bigpack_ec2_list=$bigpack_ec2_list."</tr>";
			}
			$r['bigpack_ec2_list']=$bigpack_ec2_list;
			$local_path="/home/work/local_ecplatform/jekens/result/$task_id/memory";
			if($ec_type==0)
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
				$r['memoryftp2'] = $memoryftp2;
				$r['memoryftp3'] = $memoryftp3;
				$r['memoryftp4'] = $memoryftp4;
				$cmd_speed1 = "go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.new.ec1'";
				$speed1=shell_exec("$cmd_speed1");
        	    $r['speed1'] = $speed1;
				$cmd_speed2 = "go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.new.ec2'";
        	    $speed2=shell_exec("$cmd_speed2");
     	        $r['speed2'] = $speed2;
				$cmd_speed3 = "go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.old.ec1'";
            	$speed3=shell_exec("$cmd_speed3");
            	$r['speed3'] = $speed3;
				$cmd_speed4 = "go $remote_dis_machine 'cat $LOCAL_SPEED_PATH/speed.log.old.ec2'";
      	        $speed4=shell_exec("$cmd_speed4");
          	    $r['speed4'] = $speed4;
			}
			if($ec_type==1)
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

				//END 
			$this->renderPartial('result', $r);	
		}
		//-------------
		/*public function actionResult(){
			$dir = $_GET['resultftp'];
			$task_id = $_GET['taskid'];
			//拼接结果文件ftp地址	
			$result_ftp = dirname($dir)."/data";
			$r=array();
			$r['taskid']=$task_id;
			$r['resultftp']=$result_ftp;
			$record=EcJenkinsTaskList::model()->find('TASK_ID=:TASK_ID', array(':TASK_ID'=>$task_id));
			
			$r['newolddiff']=$record->newolddiff;
			$r['newdiff']=$record->newdiff;
			$r['olddiff']=$record->olddiff;
			
			$r['memory']=$record->memory;
			$r['speed']=$record->speed;
			$r['Valgrind']=$record->Valgrind;
			
			$r['dir']=$record->RUN_RESULT;
			$newec= dirname($dir)."/code/product_new/";
			$oldec= dirname($dir)."/code/product_old/";
			$r['newec']=$newec;
			$r['oldec']=$oldec;
            $diff_ftp = dirname($dir)."/data/common";
			$cov_ftp = dirname($dir)."/data/covfile";
			//-----------------
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
            	$cmd_diffid = "wget $diff_ftp/diff_id.newold -O /home/work/ec_test_service/webroot/diff_id.newold;cat diff_id.newold";
            	$diffid=exec("$cmd_diffid");
				$cmd_rm="rm diff_id.newold";
				exec("$cmd_rm");
            	$r['diffid_newold'] = $diffid;
			}
			if($record->newdiff == 1)
			{
				$r['output_data_new']=$diff_ftp.'/common_output_new';
                $r['output_data_new_2']=$diff_ftp.'/common_output_new_2';
				$cmd_diffid = "wget  $diff_ftp/diff_id.new -O /home/work/ec_test_service/webroot/diff_id.new;cat diff_id.new;";
                $diffid=exec("$cmd_diffid");
                $r['diffid_new'] = $diffid;
			}
			if($record->olddiff == 1)
            {
                $r['output_data_old']=$diff_ftp.'/common_output_old';
                $r['output_data_old_2']=$diff_ftp.'/common_output_old_2';
				$cmd_diffid = "wget $diff_ftp/diff_id.old -O /home/work/ec_test_service/webroot/diff_id.old;cat diff_id.old";

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
			//-----------------------
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
			//END -------------------
			$this->renderPartial('result', $r);	
		}	*/
		//------------------------------
	/*	
		public function actionPerformance(){
			$task_id = $_GET['taskid'];
            $dir = $_GET['resultftp'];
            $task_id = $_GET['taskid'];
            //----------------------
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
		public function actionShowjenkinslog() {
        	$task_id = $_GET['taskid'];
            $dir = $_GET['resultftp'];
            //--------------------------  
            $result_ftp = dirname($dir);
            $r=array();
            $r['taskid']=$task_id;
			$r['resultftp']=$result_ftp;
            $record=EcJenkinsTaskList::model()->find('TASK_ID=:TASK_ID', array(':TASK_ID'=>$task_id));
			$status=$record->STATUS;
			$ec_type=$record->EC_type;
			$r['ec_type']=$ec_type;
			$r['status']=$status;
			$r['id']=json_encode(array('task_id'=>$task_id));
        	$this->renderPartial('jenkinslog', $r); 
    	}
		public function actionLog(){
            $remote_dis_machine="cp6076";
			$task_id = $_GET['taskid'];
			$r=array(); 
			$r['taskid']=$task_id;
			$command = "go $remote_dis_machine 'cat  /home/work/local_ecplatform/remote_dis_machine_script/enviroment/log/jekens/$task_id.log;'";
			$log = shell_exec($command);
		//	$file = fopen("/home/work/test.txt","w");
		//	fwrite($file,$log);
		//	fclose($file);
			
			$r['log'] = $log;
			$this->json($r);
		}
	}
?>
