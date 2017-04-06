<?php

class VersionController extends Controller
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
	/*
	public function actionIndex(){
		$model=new EcVersionControl('search');
     	$model->unsetAttributes();
     	if(isset($_GET['EcVersionControl']))
     	$model->attributes=$_GET['EcVersionControl'];
     	if(isset($_GET["EcVersionControl_sort"])){
     		$order=$_GET["EcVersionControl_sort"];
     		$order=str_replace('.',' ', $order);
     		//$model->sort_default=$order;
			$model->sort_default='id desc';
     	}
     	else{
    		$model->sort_default = 'id desc';
     	}
     	$this->render('dreport',array(
     		'model'=>$model,
     		'admin_title'=>'EC 版本列表',
     	));
	}
	*/
	public function actionIndex(){
		$data = array();
        $result = EcVersionControl::model()->findAll();
		$data['result'] = $result;
		$this->renderPartial('index',$data);
	}
	public function actionAdd($id = '')
	{
		$data = array();
		$this->renderPartial('add',$data);	

	}
	public function actionAddNewVersionAPI() {
		
	}
	public function actionModify($id = '')
	{
		$data = array();
		
        $id = intval($id);
		
        $editid = EcVersionControl::model()->findByPk($id);
		
        if(empty($editid)) throw new CHttpException('404', 'Not found!');

        $data['editid'] = $editid;
        $data['id']=$id;

        $this->renderPartial('modify',$data); 

	}
	
	public function actionUpdate($id = '')
    {
        $r['status'] = 0;
        $model=EcVersionControl::model()->findByPk($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if(isset($_POST['version'])){
            $model->version = $_POST['version'];
        }       
        if(isset($_POST['language'])){
            $model->language = $_POST['language'];
        }       
        if(isset($_POST['ecc_version'])){
            $model->ecc_version = $_POST['ecc_version'];
        }       
        if(isset($_POST['framework_version'])){
            $model->framework_version = $_POST['framework_version'];
        }       
        if(isset($_POST['pagevalue_version'])){
            $model->pagevalue_version = $_POST['pagevalue_version'];
        }       
        if(isset($_POST['is_splited'])){
            $model->is_splited = $_POST['is_splited'];
		}
		if($model->save()){
                //$this->redirect(array('view','id'=>$model->id));
                $r['status'] = 1;
            }

        $this->json($r);
        /*
        $this->render('dreport',array(
            'model'=>$model,
        ));*/
    
        }	

	 public function actionCreate()
    {
        $r['status'] = 0;
		$model=new EcVersionControl();
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
		if(isset($_POST['version'])){
			$model->version = $_POST['version'];
		}
		if(isset($_POST['language'])){
			$model->language = $_POST['language'];
		}
        if(isset($_POST['ecc_version'])){
            $model->ecc_version = $_POST['ecc_version'];
        }
        if(isset($_POST['framework_version'])){
            $model->framework_version = $_POST['framework_version'];
        }
        if(isset($_POST['pagevalue_version'])){
            $model->pagevalue_version = $_POST['pagevalue_version'];
        }
        if(isset($_POST['is_splited'])){
            $model->is_splited = $_POST['is_splited'];
        }
		/*
        if(isset($_POST['EcVersionControl']))
        {       
            $model->attributes=$_POST['EcVersionControl'];
            if($model->save()){
                //$this->redirect(array('view','id'=>$model->id));
				$r['status'] = 1;
			}
        } */
 		if($model->save()){
                //$this->redirect(array('view','id'=>$model->id));
				$r['status'] = 1;
			}
     
		$this->json($r);
		/*
        $this->render('dreport',array(
            'model'=>$model,
        ));*/     
    }
	 public function actionDelete($id = ''){
        $re = EcVersionControl::model()->deleteByPk($id);
        if($re){
            $res = array("status" => 1, "msg" => "删除成功"); 
        }else{  
            $res = array("status" => 0, "msg" => "删除失败"); 
        }       
        $this->json($res);
    }
    public function actionEdited($topic ="", $id = ""){
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
