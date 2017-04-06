<?php

class CompileController extends Controller
{
	public $layout = "main";
	public static $HOST_NAME = "yuanbaolei@cq01-testing-zfqa33.cq01.baidu.com";
	public static $COMPILE_RESULT_PATH="/home/users/yuanbaolei/LibPP/ECCompileResult";
	public static $CI_BIN="~/ci/lib/baselib/bin/";

	public function filters(){
		return Array('login - api,compile');
	}

	public function actionIndex($topic='', $state = '', $keyword = '', $page = 1, $pagesize = 30){
		$run_id="";
		$run_id= $_GET['runid'];
        $r['runid']= $run_id;
		$array = EcVersionControl::model()->findAll("",array());	
		$version_list = "";
		if (count($array) > 1)
			$version_list = $array[0]->version;
		for ($i=1;$i < count($array); $i++)
			$version_list = $version_list . "&&" .$array[$i]->version;
		$r['version_list'] = $version_list;
        $this->renderPartial('index', $r);
	}

	public function actionAbc()
	{
		echo "HELLO";
	}	


	public function actionLog($topic='', $state = '', $keyword = '', $page = 1, $pagesize = 30){
		$compile_id="";
		$compile_id= $_GET['compileid'];
        $r['compileid']= $compile_id;
		$run_id="";
		$run_id= $_GET['runid'];
        $r['runid']= $run_id;
		$this->renderPartial('log', $r);
	}

	public function actionApi() {
		$user=$_GET['usr'];
		echo $user;
	}

	public function saveTask($time,$new_version, $old_version, $user, $new_module_list, $old_module_list)
	{
		$task = new EcCompileTaskList();
		$task->time = $time;
		$task->new_version = $new_version;
		$task->old_version = $old_version;
		$task->user = $user;
		$task->host_name = self::$HOST_NAME;
		$task->new_module_list = $new_module_list;
		$task->old_module_list = $old_module_list;
		$rc = $task->save();
		if ($rc == false)
			return null;
		$task->log_path = self::$COMPILE_RESULT_PATH.strval($task->id)."/ec_compile.err";
		$task->new_output_path = self::$COMPILE_RESULT_PATH.strval($task->id)."/new/";
		$task->old_output_path = self::$COMPILE_RESULT_PATH.strval($task->id)."/old/";
		if ($rc == true)
			return $task;
		return null;
	}




	public function actionErrmsgdata(){	
		$line_count_str_err= $_POST['Count'];
		$m_id= $_POST['Mission_id'];
		$line_count_err=intval($line_count_str_err,10);
		$cmd_err = self::$CI_BIN."/go ".self::$HOST_NAME." \"sh /home/users/yuanbaolei/LibPP/compile_shell/ec_compile_log.sh ".$line_count_err." ".self::$COMPILE_RESULT_PATH."/".$m_id."/ec_compile.err\"";
		$ec_compile_err= shell_exec($cmd_err);
		$linevalues=explode("\n",$ec_compile_err);
		$err_end_flag='[MISSION COMPLETE]';
		foreach($linevalues as $line){
			$flag_result=strpos($line,$err_end_flag);
			if ($flag_result!==false){
				++$line_count_err;
				echo "<p cc='".$line_count_err."' id='missioncomplete'>".$line_count_err." ".$line."</p>\n";
			}
			elseif($line==""){}
			else{
				++$line_count_err;
				echo "<p cc='".$line_count_err."'>". $line_count_err." ".$line."</p>\n";
			}
		}
	}

	public function actionLogmsgdata(){	
		$line_count_str_log= $_POST['Count'];
		$m_id= $_POST['Mission_id'];
		$line_count_log=intval($line_count_str_log,10);
		$cmd_log = self::$CI_BIN."/go ".self::$HOST_NAME." \"sh /home/users/yuanbaolei/LibPP/compile_shell/ec_compile_log.sh ".$line_count_log." ".self::$COMPILE_RESULT_PATH."/".$m_id."/ec_compile.log\"";
		$ec_compile_log= shell_exec($cmd_log);
		$linevalues=explode("\n",$ec_compile_log);
		$log_end_flag='[MISSION COMPLETE]';
		foreach($linevalues as $line){
			$flag_result=strpos($line,$log_end_flag);
			if ($flag_result!==false){
				++$line_count_log;
				echo "<p ccc='".$line_count_log."' id='logmissioncomplete'>".$line_count_log." ".$line."</p>\n";
			}
			elseif($line==""){}
			else{
				++$line_count_log;
				echo "<p ccc='".$line_count_log."'>". $line_count_log." ".$line."</p>\n";
			}
		}
	}


	public function actionCompile(){
		$fp = fopen("/home/work/zhanghao15/record.txt","w");

		$NEWEC_PATTERN = $_POST['NewEC_Pattern'];
		if($NEWEC_PATTERN=="Url")
		{
			fputs($fp,"New EC Url: ");
			fputs($fp,$_POST['NewEC_Url']."\n");
			$new_ec_flag = "svn";
		}
		else if($NEWEC_PATTERN=="Version")
		{
			$array = EcVersionControl::model()->findAll("version=:version",array(':version'=>$_POST['NewEC_Version']));
			$array[0]->version_4;
			$new_version4 = str_replace(".","-",$array[0]->version_4);
			fputs($fp,"New EC Version: ");
            fputs($fp,$_POST['NewEC_Version']."\n");
			fputs($fp,$array[0]->version_4."\n");
			fputs($fp,$new_version4."\n");
			$new_ec_flag = "tag";	
		}
		else
		{
			fputs($fp,"New EC is wrong!\n");
		}

		
		$OLDEC_PATTERN = $_POST['OldEC_Pattern'];
		if($OLDEC_PATTERN=="Url")
		{
			fputs($fp,"Old EC Url: ");
			fputs($fp,$_POST['OldEC_Url']."\n");
			$old_ec_flag = "svn";
		}
		else if($OLDEC_PATTERN=="Version")
		{
			$array = EcVersionControl::model()->findAll("version=:version",array(':version'=>$_POST['OldEC_Version']));
			$array[0]->version_4;
			$old_version4 = str_replace(".","-",$array[0]->version_4);
			fputs($fp,"Old EC Version: ");
            fputs($fp,$_POST['OldEC_Version']."\n");
			fputs($fp,$array[0]->version_4."\n");
			fputs($fp,$old_version4."\n");
			$old_ec_flag = "tag";
		}
		else
		{
			fputs($fp,"Old EC is wrong!\n");
		}


		$RUN_TASK_ID = $_POST['Run_Task_Id'];
	
		$DEPENDENCE_COUNT = $_POST['Dependence_Count'];
	
		$new_module = [];
		$old_module = [];
		for($i=0;$i<$DEPENDENCE_COUNT;$i++)
        {
			if ($_POST['Dependence_name'.$i] != "" && $_POST['Dependence_new_ver'.$i] != "")
			{
				array_push($new_module,$_POST['Dependence_name'.$i]."@".$_POST['Dependence_new_ver'.$i]);
			}
			if ($_POST['Dependence_name'.$i] != "" && $_POST['Dependence_old_ver'.$i] != "")
			{
				array_push($old_module,$_POST['Dependence_name'.$i]."@".$_POST['Dependence_old_ver'.$i]);
			}
			fputs($fp,$_POST['Dependence_name'.$i]."\n");
			fputs($fp,$_POST['Dependence_new_ver'.$i]."\n");
			fputs($fp,$_POST['Dependence_old_ver'.$i]."\n");
		}
		$new_module_list=join("&&",$new_module);
		$old_module_list=join("&&",$old_module);
	

		$time = date('Y-m-d H:i:s',time());
		$user = Yii::app()->user->name;
		
		$task = $this->saveTask($time,$new_version4,$old_version4,$user,$new_module_list,$old_module_list);
		if (is_null($task))
		{
			fputs($fp,"save Task Failed");
			return true;
		}
		if($RUN_TASK_ID!=false)
		{
			$task_run = EcRunTaskList::model()->findByPk($RUN_TASK_ID);
        	if (is_null($task_run))
        	{
            	//echo "find task failed"."\n";
           		//return 0;
        	}

        	$task_run->bin_output_new = $task->new_output_path;
        	$task_run->bin_output_old = $task->old_output_path;
        	$task_run->save();
	
			if($task_run->related_run_id!=NULL)
			{
			$RUN_TASK_ID_2=$task_run->run_task_id;
			$task_run_2 = EcRunTaskList::model()->findByPk($RUN_TASK_ID_2);
        	if (is_null($task_run_2))
        	{
            	//echo "find task failed"."\n";
           		//return 0;
        	}
			
        	$task_run_2->bin_output_new = $task->new_output_path;
        	$task_run_2->bin_output_old = $task->new_output_path;
        	$task_run_2->save();
			}
		}

		$cmd = self::$CI_BIN."/go ".self::$HOST_NAME." \"cd /home/users/yuanbaolei/LibPP/compile_shell; sh -x call_ec_compile.sh -n \\\"".$new_version4."\\\" -N \\\"".$new_ec_flag."\\\" -o \\\"".$old_version4."\\\" -O \\\"".$old_ec_flag."\\\" -l \\\"".$new_module_list."\\\" -L \\\"".$old_module_list."\\\" -i ".strval($task->id)."\" 2>~/LibPP/compile_errorlog";
		$ret = shell_exec($cmd);
		fputs($fp,$cmd."\n");
		fputs($fp,$ret);
        fclose($fp);

		echo strval($task->id);

	}
	
    public function actionEdit($topic ="", $id = ""){
        if(!$id){
          $is_new = 1;

          $project = new Project;
          $project->create_time = time();
          $project->act_lift_time = time();
          $project->create_user = Yii::app()->user->name;
        }else{
          $is_new = 0;
          $project = Project::model()->findByPk($id);
          if(empty($project)) throw new CHttpException('404', 'Not Found!');
        }
      
        if(isset($_POST['act'])&&$_POST['act']=='edit'){
           unset($_POST['act']);
           $project->attributes = $_POST;
           $project->update_time = time();
           $project->update_user = Yii::app()->user->name;
           ##调用邮件函数
           $ret = SendMail($topic,$project,$is_new);

          if($project->save() and $ret == true){
              $this->json(array('status' => 1));
          }else{
              $this->json(array('status' => 0));
          }
        }elseif($is_new==0){
          $r['project'] = $project;
        }

        $r['topic'] = $topic?$topic:$project->topic_id;
        $r['id'] = $id;
        $r['project'] = $project;
        $r['priority_list'] = ProjectMsg::getPriorityList();
        $r['level_list'] = ProjectMsg::getLevelList();
        $r['state_list'] = ProjectMsg::getStateList();
        $r['topic_list'] = ProjectMsg::getTopicList();
        $this->renderPartial('edit', $r);
    }


    public function actionDel()
    {
        $res = array("status" => 0, "msg" => "删除失败");

        $id = $_POST['id'];
        //先从数据表中删除该id
        $prj = Project::model()->findByPk($id);
        if($prj){
            $prj->is_del = 1;
            $ret = SendMail($prj->topic_id,$prj,3);
            if($prj->save() and $ret == true){      
                $res = array("status" => 1, "msg" => "删除成功"); 
            }
        }
   
        $this->json($res);    
    }  

    public function actionManage(){
        $res = array("status" => 0, "msg" => "更新失败"); 
        $flag = 2;

        $id = $_POST['id'];
        $prj = Project::model()->findByPk($id);
        if($prj){
            $prj->update_time = time(); 
            $prj->update_user = Yii::app()->user->name;
            $prj->topic_id = $_POST['topic'];
            $prj->state = $_POST['state'];
            $prj->qa_master = htmlentities($_POST['qa_master']);
            $prj->qa_reviewer = htmlentities($_POST['qa_reviewer']);
            $prj->act_lift_time = strtotime($_POST['act_lift_time']);
            $prj->report_time = strtotime($_POST['report_time']);
            $qa_time = $prj->report_time - $prj->act_lift_time;
            $prj->qa_time = ($qa_time>0?$qa_time:0)/86400;            
            ##调用邮件函数
            $ret = SendMail($prj->topic_id,$prj,$flag);

            if($prj->save() and $ret == 1){      
                $res = array("status" => 1, "msg" => "更新成功"); 
            }       
        }       
   
        $this->json($res); 
    }

}
