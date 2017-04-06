<?php

class DiffController extends Controller
{
	public $layout = "main";
    public static $HOST_NAME = "work@cp01-qa-spider004.cp01.baidu.com";
	public static $HOST_NAME_1 = "spider@cq01-testing-ps7161.cq01";
	public static $FTP_NAME_1 = "cq01-testing-ps7161.cq01";
    public static $DIFF_RESULT_PATH="/home/work/LibPP/DIFF_RESULT";
    public static $DIFF_SHELL_PATH="/home/work/ec_test_service/src/commands";
    public static $CI_BIN="~/ci/lib/baselib/bin/";
    public static $FTP_NAME = "cp01-qa-spider004.cp01.baidu.com";
	public static $RESULT_PATH="/home/work/LibPP/DIFF_RESULT/";
	public static $DIFF_TOOL_PATH = "/home/work/ec_test_service/src/commands/";
	public static $EACH_PAGE_SHOW_NUM = "10";
/*
    public public function filters(){
		return Array('login - ResultanalysisAPI');
	}*/
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
	public function saveDiffTask($time,$user_name,$mission_description,$new_version,$old_version,$ec_type,$new_input_path, $old_input_path)
    {
        $task = new EcDiffTaskList();
        $task->time = $time;
        $task->user = $user_name;
        $task->host_name = self::$HOST_NAME_1;
		$task->mission_description = $mission_description;
        $task->new_version = $new_version;
        $task->old_version = $old_version;
        $task->ec_type = $ec_type;
        $task->new_input_path = $new_input_path;
        $task->old_input_path = $old_input_path;
        $rc = $task->save();
        if ($rc == false)
            return null;
        $task->log_path = self::$RESULT_PATH.strval($task->diff_task_id)."/diff_result.err";
        $rc = $task->save();
        if ($rc == true)
            return $task;
        return null;
    }


	public function actionIndex($topic='', $state = '', $keyword = '', $page = 1, $pagesize = 30){
		$r['topic']= "diff"	;
        $this->renderPartial('index', $r);
	}
	
    public function actionResultanalysis($topic='', $state = '', $keyword = '', $page = 1, $pagesize = 30){
        $diff_id="";
        $diff_id= $_GET['diffid'];
        $run_id= $_GET['runid'];
        $diff_id_two[0]="null";
        $diff_id_two[1]="null";
        if($diff_id!="")
        {       
            $diff_num=1;
            $diff_id_two[0]=$diff_id;
        }       
        else    
        {       
            $diff_num=0;
        }       
        if($run_id!="")
        {       
            $diff_num=0;
            $run_id_two[0]=$run_id;
            $run_id_two[1]=$run_id+1;
            for($ii=0;$ii<2;$ii++)
            {       
                $criteria = new CDbCriteria;
                $criteria->condition='run_task_id='.$run_id_two[$ii];
                $run_task=EcRunTaskList::model()->find($criteria);
                if(is_null($run_task))
                {       
                    echo "find run task failed"."\n";
                    break;  
                }       
                if($run_task->diff_id==NULL)
                {       
					$time = date('Y-m-d H:i:s',time());
                    $user_name = Yii::app()->user->name;
                    $MISSION_DESCRIPTION = "Diff Task From Run Module. Run Id: ".$run_id_two[$ii];
                    $NEWEC_VERSION = $run_task->bin_output_new;
                    $OLDEC_VERSION = $run_task->bin_output_old;
                    $EC_TYPE=$run_task->ec_type;
                    $NEWEC_INPUT="ftp://".$run_task->host_name.$run_task->run_path."/".$run_id_two[$ii]."/new";
                    $OLDEC_INPUT="ftp://".$run_task->host_name.$run_task->run_path."/".$run_id_two[$ii]."/old";

                    $diff_task = $this->saveDiffTask($time,$user_name,$MISSION_DESCRIPTION,$NEWEC_VERSION,$OLDEC_VERSION,$EC_TYPE,$NEWEC_INPUT,$OLDEC_INPUT);
                    $result_path = self::$RESULT_PATH.strval($diff_task->diff_task_id);
                    exec("mkdir -p ".$result_path);
                    $cmd = "nohup sh -x ".self::$DIFF_TOOL_PATH."/diff_ec_result.sh ".$NEWEC_INPUT." ".$OLDEC_INPUT." ".$result_path." 2>".$result_path."/diff_ec_result.err 1>".$result_path."/diff_ec_result.log &";
                    exec($cmd);
                    $diff_id_two[$ii]=$diff_task->diff_task_id;
                    $run_task->diff_id = $diff_id_two[$ii];
                    $run_task->save();
                }
                else
                {
                    $diff_id_two[$ii]=$run_task->diff_id;
                }
                $diff_num=$diff_num+1;
                if($run_task->related_run_id==NULL)
                {
                    break;
                }
            }
       }
        $r['diff_id1']= $diff_id_two[0];
        $r['diff_id2']= $diff_id_two[1];
        $r['diff_num']= $diff_num;
        $this->renderPartial('resultanalysis', $r);
    }
	
	public function actionTestAPI() {
		echo Yii::app()->request->userHostAddress;
	}
	
	
	public function actionResultanalysisAPI() {
		$discription=$_POST["discription"];
		$new_version=$_POST["new_version"];
		$old_version=$_POST["old_version"];
		$lang=$_POST["lang"];
		if (is_null($lang) || $lang == "")
			$lang = "chineseec";
		$new_data_path=$_POST["new_path"];
		$old_data_path=$_POST["old_path"];	
        $time = date('Y-m-d H:i:s',time());
        $user_name = "machine";
        $diff_task = $this->saveDiffTask($time,$user_name,$discription,$new_version,$old_version,$lang,$new_data_path,$old_data_path);
        $result_path = self::$RESULT_PATH.strval($diff_task->diff_task_id);
        exec("mkdir -p ".$result_path);
        $cmd = "nohup sh -x ".self::$DIFF_TOOL_PATH."/diff_ec_result.sh ".$new_data_path." ".$old_data_path." ".$result_path." 2>".$result_path."/diff_ec_result.err 1>".$result_path."/diff_ec_result.log &";
        exec($cmd);
		echo $diff_task->diff_task_id;
	}
	
	public function actionChangeTaskItemAPI()
	{
		$key = $_POST["key"];
		$value = $_POST["value"];
		$task_id = $_POST["task_id"];
		$task = EcDiffTaskList::model()->findByPk($task_id);
		if (is_null($task))
			return true;
		if ($key == "status")
		{
			$task->status = $value;
		}
		$rc = $task->save();
		return true;
	}
		

	public function actionRead($topic='', $state = '', $keyword = '', $page = 1, $pagesize = 30){
		$diff_id="null";
		$doc_name= "null";
		$file_name= "null";
		$diff_id= $_GET['diffid'];
		$doc_name= $_GET['docname'];
		$file_name= $_GET['filename'];
		$page_num= $_GET['pagenum'];
        $r['diff_id']= $diff_id;
        $r['doc_name']= $doc_name;
        $r['file_name']= $file_name;
		
		if($page_num=="")
		{
			$r['page_num']= 1;
			$page_num= 1;
		}	
		else
		{
			$r['page_num']= $page_num;
		}

		$cmd_read = "sh ".self::$DIFF_SHELL_PATH."/diff_ec_result_show.sh ".self::$DIFF_RESULT_PATH."/".$diff_id."/diffpacket_result/".$doc_name."/".$file_name." ".$page_num." ".self::$EACH_PAGE_SHOW_NUM;
		//echo $cmd_read;
        $ec_diff_read=shell_exec($cmd_read);
        $r['ec_diff_read']= $ec_diff_read;

		$this->renderPartial('read', $r);
	}
 public function actionSummery($topic='', $state = '', $keyword = '', $page = 1, $pagesize = 30){
		$diff_id="null";
        $doc_name= "null";
        $file_name= "null";
        $diff_id= $_GET['diffid'];
        $doc_name= $_GET['docname'];
        $file_name= $_GET['filename'];
        $page_num= $_GET['pagenum'];
        $r['diff_id']= $diff_id;
        $r['doc_name']= $doc_name;
        $r['file_name']= $file_name;
	
		$fp=fopen("/home/work/LibPP/DIFF_RESULT/$diff_id/LINK_DIFF/summery.txt","r");
		if($fp)
			for($i=1;!feof($fp);$i++)
				$line .= fgets($fp) . "\n";
		else
			echo "打开文件失败";
		$r['line'] = $line;
		$this->renderPartial('summery', $r);
	}

	public function actionLinks($diffid, $docname, $filename, $value="")
	{	
		$diff_id="null";
        $doc_name= "null";
        $file_name= "null";
        $diff_id= $_GET['diffid'];
        $doc_name= $_GET['docname'];
        $file_name= $_GET['filename'];
        $r['diff_id']= $diff_id;
        $r['doc_name']= $doc_name;
        $r['file_name']= $file_name;
         //根据新增项，不同项，丢失项不同，grep不同。以下只有一个新增项
	    //grep links  
		if($doc_name == "new_field")
		{
    		$cmd_grep = "grep "."'\[url=".$value."\]' ".self::$DIFF_RESULT_PATH."/".$diff_id."/new.links";
    		$grep_result = shell_exec($cmd_grep);
        	$r['grep_result']=$grep_result;
			$this->renderPartial('link',$r);
		}
		else if($doc_name == "miss_field")
		{
			$cmd_grep = "grep "."'\[url=".$value."\]' ".self::$DIFF_RESULT_PATH."/".$diff_id."/old.links";
            $grep_result = shell_exec($cmd_grep);
            $r['grep_result']=$grep_result;
            $this->renderPartial('link',$r);
		}
		else if($doc_name == "diff_field")
		{
			$cmd_grep = "grep "."'\[url=".$value."\]' ".self::$DIFF_RESULT_PATH."/".$diff_id."/LINK_DIFF/.temp.diff.file";
			$grep_result = shell_exec($cmd_grep);
			//var_dump($grep_result); exit;
			$r['grep_result']=$grep_result;
			$cmd_grep = "grep "."'\[url=".$value."\]' ".self::$DIFF_RESULT_PATH."/".$diff_id."/LINK_DIFF/old_link_file.txt";
			$grep_result = shell_exec($cmd_grep);
			$r['grep_result_delete']=$grep_result;
			$cmd_grep = "grep "."'\[url=".$value."\]' ".self::$DIFF_RESULT_PATH."/".$diff_id."/LINK_DIFF/new_link_file.txt";
			$grep_result = shell_exec($cmd_grep);
			$r['grep_result_add']=$grep_result;
			$this->renderPartial('link',$r);
		}
	}
	public function actionPvdetailread($topic='', $state = '', $keyword = '', $page = 1, $pagesize = 30){
		$diff_id= $_GET['diffid'];
		$url = urldecode($_GET['url']);
		$line_num= $_GET['linenum'];
        $r['diff_id']= $diff_id;
		$cmd_pv_detail_read = "sh ".self::$DIFF_SHELL_PATH."/diff_ec_pvdetail_show.sh ".self::$DIFF_RESULT_PATH."/".$diff_id."/pvdetail/ \"".$url."\"";
        $ec_diff_pvdetail_read=shell_exec($cmd_pv_detail_read);
        $r['ec_diff_pvdetail_read']= $ec_diff_pvdetail_read;
		$this->renderPartial('pvdetailread', $r);
	}


	public function actionUpload(){
		//$fp = fopen("/home/work/zhanghao15/record.txt","w");
		$MISSION_DESCRIPTION = $_POST['Mission_Description'];
		$NEWEC_VERSION = $_POST['NewEC_Ver'];
		$OLDEC_VERSION = $_POST['OldEC_Ver'];
		$NEWEC_INPUT= $_POST['NewEC_input'];
		$OLDEC_INPUT= $_POST['OldEC_input'];
		$EC_TYPE= $_POST['EC_Type'];

		$time = date('Y-m-d H:i:s',time());
		$user_name = Yii::app()->user->name;

		//echo "1:".$MISSION_DESCRIPTION."\n";
		//echo "2:".$NEWEC_VERSION."\n";
		//echo "3:".$OLDEC_VERSION."\n";
		//echo "4:".$NEWEC_INPUT."\n";
		//echo "5:".$OLDEC_INPUT."\n";
		//echo "6:".$EC_TYPE."\n";
		//echo "7:".$time."\n";
		//echo "8:".$user_name."\n";



		
		$task = $this->saveDiffTask($time,$user_name,$MISSION_DESCRIPTION,$NEWEC_VERSION,$OLDEC_VERSION,$EC_TYPE,$NEWEC_INPUT,$OLDEC_INPUT);
		$result_path = self::$RESULT_PATH.strval($task->diff_task_id);
		exec("mkdir -p ".$result_path);
		$cmd = "nohup sh -x ".self::$DIFF_TOOL_PATH."/diff_ec_result.sh ".$NEWEC_INPUT." ".$OLDEC_INPUT." ".$result_path." ".$EC_TYPE." 2>".$result_path."/diff_ec_result.err 1>".$result_path."/diff_ec_result.log &";
		exec($cmd);
		//$ret = shell_exec($cmd);
		//fputs($fp,$cmd."\n");
		//fputs($fp,$ret);
        //fclose($fp);

		//test
		echo $task->diff_task_id;
	}

	public function actionResultdata(){	
		$diff_id= $_POST['Diff_id'];
		$cmd_result = "sh ".self::$DIFF_SHELL_PATH."/diff_ec_result_analysis.sh ".self::$DIFF_RESULT_PATH."/".$diff_id."/diffpacket_result/summary";
        $ec_diff_result=shell_exec($cmd_result);
        $line_count=0;
        $linevalues=explode("\n",$ec_diff_result);
        $New_flag='NEW_ITEMS';
        $Miss_flag='MISS_ITEMS';
        $Diff_flag='DIFF_ITEMS';
        $flag_result=0;
        $pack_total=0;
        foreach($linevalues as $line){
            $New_flag_result=strpos($line,$New_flag);
            $Miss_flag_result=strpos($line,$Miss_flag);
            $Diff_flag_result=strpos($line,$Diff_flag);
            if ($New_flag_result!==false){
                $flag_result="new_field";
				echo "<!-- --><!-- mark -->\n<!-- New_Items -->\n";
                continue;
            };
            if ($Miss_flag_result!==false){
                $flag_result="miss_field";
                echo "<!-- --><!-- mark -->\n<!-- Miss_Items -->\n";
                continue;
            };
            if ($Diff_flag_result!==false){
                $flag_result="diff_field";
                echo "<!-- --><!-- mark -->\n<!-- Diff_Items -->\n";
                continue;
            };
            //No data clear
            if($line==""){}
            //first line disposal
            elseif($line=="[FAIL] CONFLICTING_ARGUMENTS"){echo "<!-- mark -->\n<!-- Loading -->\n";}
			elseif($line_count==0){
                ++$line_count;
                echo "<!-- mark -->\n<!-- First Line -->\n";
                echo "<tr style=\"word-break:break-all;\">\n";
                $diffkeyvalue=explode(" ",$line);
                foreach($diffkeyvalue as $keyvalue){
                    list($diffkey,$diffvalue)=split('[=]',$keyvalue);
                    //echo "<td width=\"12.5%\"><div align=\"center\">".$diffvalue."</div></td>\n";
                    echo "<td>".$diffvalue."</td>\n";
                
					if($diffkey=="same_pack")
					{
						$pack_total=$pack_total+$diffvalue;
					}
					elseif($diffkey=="diff_pack")
					{
						$pack_total=$pack_total+$diffvalue;
					}
                }
				echo "</tr>\n";
				
            }
            else{
                ++$line_count;
				$kv=0;
                echo "<tr style=\"word-break:break-all;\">\n";
                $diffkeyvalue=explode("\t",$line);
                $filename="";
				$wrongpercent=0;
				foreach($diffkeyvalue as $keyvalue){
                    if($keyvalue==""){}
                    else{
                	if($kv==0){
						$filename=$keyvalue;
                    	echo "<td cc='".$flag_result."'>".$keyvalue."</td>\n";
						$kv=1;
					}
					elseif($kv==1){
						$wrongpercent=sprintf("%.2f",$keyvalue/$pack_total*100);//$keyvalue/$pack_total*100;
                    	echo "<td cc='".$flag_result."'><div align=\"left\">".$keyvalue."</div></td>\n";
					}
					}
				}
				echo "<td cc='".$flag_result."'><div align=\"left\">".$wrongpercent."%</div></td>\n";
				echo "<td cc='".$flag_result."'><input style='display:none' id='copy".$line_count."' value='ftp://".self::$FTP_NAME.self::$DIFF_RESULT_PATH."\n/".$diff_id."/diffpacket_result/".$flag_result."/".$filename."'><a id=\"urlid".$line_count."\" title='复制' onclick=\"toClipboard(this.id,'copy".$line_count."')\">ftp://".self::$FTP_NAME.self::$DIFF_RESULT_PATH."\n/".$diff_id."/diffpacket_result/".$flag_result."/".$filename."</td>\n";
                echo "<td cc='".$flag_result."'><div align=\"left\">";
             echo "<a href=\"?r=diff/read&diffid=".$diff_id."&docname=".$flag_result."&filename=".$filename."\" target=\"_blank\">详情</a>";
				if(strpos($filename,"links"))
					echo "<a href=\"?r=diff/summery&diffid=".$diff_id."&docname=".$flag_result."&filename=".$filename."\" target=\"_blank\">统计</a>";
				echo "</div></td>\n";
				echo "</tr>\n";
            }
        }
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
