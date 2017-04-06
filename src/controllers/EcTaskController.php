<?php

class EcTaskController extends Controller
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
	public function actionChangeTaskStatusAPI(){
		$task_id = $_GET['task_id'];
		$status = $_GET['status'];
		$task = EcCompileTaskList::model()->findByPk($task_id);
		if (is_null($task))
		{
			echo "find task failed"."\n";
			return 0;
		}
		$task->status = $status;
		$task->save();
		echo "SUC";
	}
/*
	public function actionCompile(){
        $model=new EcCompileTaskList('search');
        $model->unsetAttributes();
        //var_dump($_GET['EcCompileTaskList']);exit;
		if(isset($_GET['EcCompileTaskList']))
        	$model->attributes=$_GET['EcCompileTaskList'];
        if(isset($_GET["EcCompileTaskList_sort"])){
            $order=$_GET["EcCompileTaskList_sort"];
            $order=str_replace('.',' ', $order);
            //$model->sort_default=$order;
            $model->sort_default='id desc';
        }
        else{
            $model->sort_default = 'id desc';
        }
        $this->render('dreport',array(
            'model'=>$model,
            'admin_title'=>'EC 编译任务列表',
        ));
    }
*/
	public function actionDreport()
	{
		$model=new EcSummaryList();
        $model->unsetAttributes();
        if(isset($_GET['EcSummaryList']))
            $model->attributes=$_GET['EcSummaryList'];
        /*
        if(isset($_GET["EcSummaryList_sort"])){
            $order=$_GET["EcSummaryList_sort"];
            $order=str_replace('.',' ', $order);
            //$model->sort_default=$order;
            $model->sort_default='ID desc';
        }
        else{
            $model->sort_default = 'ID desc';
        }
        */

        $this->render('summary',array(
            'model'=>$model,
            'admin_title'=>'EC 结果统计任务列表',
        ));
	}
/*
	public function actionDiffmission(){
        $model=new EcDiffTaskList();
        $model->unsetAttributes();
		if(isset($_GET['EcDiffTaskList']))
        	$model->attributes=$_GET['EcDiffTaskList'];
        
		if(isset($_GET["EcDiffTaskList_sort"])){
            $order=$_GET["EcDiffTaskList_sort"];
            $order=str_replace('.',' ', $order);
            //$model->sort_default=$order;
            $model->sort_default='diff_task_id desc';
        }
        else{
            $model->sort_default = 'diff_task_id desc';
        }
		
        $this->render('diffmission',array(
            'model'=>$model,
            'admin_title'=>'EC 结果分析任务列表',
        ));
    }
	*/
	public function actionDiffmission(){
        $data = array();
        $result = EcDiffTaskList::model()->findAll();
//      foreach ($result as $item)
//          var_dump($item["run_task_id"]);
//      exit();
        $data['result'] = $result;
        $this->renderpartial('diffmission',$data);

    }
	public function actionEcmonitormission()
	{
		$data = array();
		$result = EcMonitor::model()->findAll();
		$data['result']=$result;
		$this->renderpartial("ecmonitormission",$data);
	}
/*
	public function actionRunmission(){
        $model=new EcRunTaskList('search');
        $model->unsetAttributes();
        if(isset($_GET['EcRunTaskList']))
        $model->attributes=$_GET['EcRunTaskList'];
        if(isset($_GET["EcRunTaskList_sort"])){
            $order=$_GET["EcRunTaskList_sort"];
            $order=str_replace('.',' ', $order);
            //$model->sort_default=$order;
            $model->sort_default='run_task_id desc';
        }
        else{
            $model->sort_default = 'run_task_id desc';
        }
        $this->render('runmission',array(
            'model'=>$model,
            'admin_title'=>'EC 运行任务列表',
        ));
    }

*/
	public function actionRunmission(){
		$data = array();
		$result = EcRunTaskList::model()->findAll();
//		foreach ($result as $item)
//			var_dump($item["run_task_id"]);
//		exit();
		$data['result'] = $result;
		$this->renderpartial('runmission',$data);

	}

	 public function actionLocalmission(){
        $data = array();
        $result = EcLocalTaskList::model()->findAll();
        $data['result'] = $result;
        $this->renderpartial('localmission',$data);

    }
		public function actionJenkinsmission(){
        $data = array();
        $result = EcJenkinsTaskList::model()->findAll();
        $data['result'] = $result;
        $this->renderpartial('jenkinsmission',$data);

    }

	 public function actionLocalmission_liupan(){
        $data = array();
        $result = EcLocalTaskList::model()->findAll();
        $data['result'] = $result;
        $this->renderpartial('localmission_liupan',$data);

    }
		
}
