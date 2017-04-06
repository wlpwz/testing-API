<?php
class DefaultController extends Controller
{
//	public $layout = "index";
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
		$this->render('index', $r);
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
