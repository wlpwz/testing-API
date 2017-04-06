<?php

class RequirementController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public $layout = 'monitem2';
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionAdd()
	{
		$this->render('add');
	}
  
  public function actionModify($id = -1)
  {
    if($id < 0) {
      echo "please specify the case id";
      return;
    }
    $data['case'] = CaseInfo::model()->find("id = :id", array("id"=>$id));
    $data['categoryList'] = CaseInfo::model()->findAllBySql("select category from case_info group by category");
    $this->render('modify', $data);
  }
  
   public function actionModify2($id)
  {
    $date['case'] = CaseInfo::model()->find("id = :id", array("id"=>$id));
    if(isset($_POST)) {
      $pd = CaseInfo::model()->find("id = :id", array("id"=>$id));                                                                         
      $pd->owner = $_POST['owner'];                                                                                                        
      $pd->category = $_POST['category'];                                                                                                  
      $pd->state = $_POST['state'];                                                                                                        
      $pd->conclusion = $_POST['conclusion'];                                                                                              
      $pd->update_time = time();                                                                                                           
      $pd->save();                                                                                                                         
      $this->actionProblemtab();                                                                                                                 
    } else {                                                                                                                               
      echo "unknown page";                                                                                                                 
    }
  }
  public function actionAdd2()
  {
    if(isset($_POST['description']) && isset($_POST['case_day'])
        && isset($_POST['owner']) && isset($_POST['state'])) {
      $pd = new CaseInfo();
      $pd->description = $_POST['description'];
      $pd->case_day = $_POST['case_day'];
      $pd->owner = $_POST['owner'];
      $pd->category = $_POST['category'];
      $pd->state = $_POST['state'];
      $pd->create_time = time();
      $pd->update_time = time();
      $pd->save();
      $this->actionProblemtab();
      return;
    }
    $this->render('add2');
  }
  public function actionProblemtab()
  {
    $data['typeList'] = array();                                                                                                           
    $data['timeList'] = array();                                                                                                           
    $pd = CaseInfo::model()->findAll();                                                                                                    
    if($pd) {                                                                                                                              
      foreach($pd as $row) {                                                                                                               
        if(array_key_exists($row->category, $data['typeList'])) {                                                                          
          $data['typeList'][$row->category] += 1;                                                                                          
        } else {                                                                                                                           
          $data['typeList'][$row->category] = 1;                                                                                           
        }
        if(array_key_exists(strtotime($row->case_day), $data['timeList'])) {                                                               
          $data['timeList'][strtotime($row->case_day)] += 1;                                                                               
        } else {                                                                                                                           
          $data['timeList'][strtotime($row->case_day)] = 1;                                                                                
        }
      }
    }

    $data['caseList'] = CaseInfo::model()->findAll("id > 0 order by id desc");                                                             
    $this->render('problemtab', $data); 
  }
  public function actionProblempic()
  {
    $data['typeList'] = array();
    $data['timeList'] = array();
    $pd = CaseInfo::model()->findAll();
    if($pd) {
      foreach($pd as $row) {
        if(array_key_exists($row->category, $data['typeList'])) {
          $data['typeList'][$row->category] += 1;
        } else {
          $data['typeList'][$row->category] = 1;
        }
        if(array_key_exists(strtotime($row->case_day), $data['timeList'])) {
          $data['timeList'][strtotime($row->case_day)] += 1;
        } else {
          $data['timeList'][strtotime($row->case_day)] = 1;
        }
      }
    }

    $data['caseList'] = CaseInfo::model()->findAll("id > 0 order by id desc");
    $this->render('problempic', $data);
  }

  public function actionQuery()
  {
    $from = "'".$_POST['from']."'";
    $to = "'".$_POST['to']."'";
    $state = $_POST['state'];
    $crition = array();
    if($state==0)                                                                                                                    
    {$crition['condition'] = "`alarm_time` between $from and $to";}
    else
    {$crition['condition'] = "`alarm_time` between $from and $to and `status`=$state";}
    $as = AlarmState::model()->findAll($crition);                                                                                          
    $data = array();                                                                                                                       
    foreach($as as $val){                                                                                                                  
          $tmp = array();                                                                                                                  
          $tmp['id'] = $val->id;                                                                                                           
          $tmp['plat'] = $val->plat;                                                                                                       
          $tmp['alarm_type'] = $val->alarm_type;                                                                                           
          $tmp['alarm_title'] = $val->alarm_title;                                                                                         
          $tmp['alarm_content'] = $val->alarm_content;                                                                                     
          $tmp['alarm_time'] = $val->alarm_time;                                                                                           
          $tmp['alarm_reason'] = $val->alarm_reason;                                                                                       
          $tmp['alarm_id'] = $val->alarm_id;                                                                                               
          $tmp['status'] = $val->status;                                                                                                   
          $tmp['level'] = $val->level;                                                                                                     
          $data['alarm'][] = $tmp;                                                                                                         
      }
    $crition['condition'] = "`alarm_reason`=1";
    $unstable = AlarmState::model()->count($crition);
    $crition['condition'] = "`alarm_reason`=2";
    $wb = AlarmState::model()->count($crition);
    $crition['condition'] = "`alarm_reason`=3";
    $find = AlarmState::model()->count($crition);
    $crition['condition'] = "`alarm_reason`=4";
    $unfind = AlarmState::model()->count($crition);
    $all=$unstable+$wb+$find;
    if($all==0)
    {
     $data["unstable"]=0;
     $data["wb"]=0;
     $data["find"]=0;
    }
    else
    {
    $data["unstable"]=round($unstable/$all,4)*100;
    $data["wb"]=round($wb/$all,4)*100;
    $data["find"]=round($find/$all,4)*100;
    }
    if($find+$unfind==0)
    {
    $data["find2"]=0;
    $data["unfind"]=0;
    }
    else
    {
    $data["find2"]=round($find/$find+$unfind,4)*100;
    $data["unfind"]=round($unfind/$find+$unfind,4)*100;                                                                                    
    }
    $this->render('index',$data);     
  }
	public function actionGetItem()
	{
		$id = $_POST['id'];
		$pd = Requirement::model()->find("id = :id", array("id"=>$id));
		if($pd) {
			$this->json(ActiveRecord::artoarray($pd));
		}
	}

	public function actionSaveItem()
	{
		$pd = Requirement::model()->find("id = :id", array("id"=>$_POST['id']));
		$pd->name = $_POST['name'];
		$pd->file = $_POST['file'];
		$pd->proposer = $_POST['proposer'];
		$pd->state = $_POST['state'];
		$pd->online_url = empty($_POST['online_url'])?"":$_POST['online_url'];
		$pd->category = $_POST['category'];
		$pd->update_user = Yii::app()->user->name;
		$pd->update_time = time();

		if($pd->save()) {
			$this->json(1);
		} else {
			$this->json(0);
		}
	}

	public function actionAddItem()
	{
		if(empty($_POST)){
				throw new CHttpException(400, "请求不合法!");    
		}
		if(Requirement::model()->exists("name = :name", array("name" => $_POST['name']))) {
			throw new CHttpException(400, "该需求已存在!");
		}

		$pd = new Requirement();
		$pd->name = $_POST['name'];
		$pd->file = $_POST['file'];
		$pd->proposer = $_POST['proposer'];
		$pd->create_time = time();
		$pd->state = $_POST['state'];
		$pd->category = $_POST['category'];
		$pd->update_user = Yii::app()->user->name;
		$pd->update_time = time();
	/*	if($_POST['create_time']){
      $pd->create_time = strtotime($_POST['create_time']);
    }
    if($_POST['update_time']){
      $pd->create_time = strtotime($_POST['update_time']);
    } */

		$pd->save();
		$this->actionList();
	}
  public function actionIndex(){
    $crition = array();
    $crition['condition'] = "1=1";
    $as = AlarmState::model()->findAll($crition);
    $data = array();
    foreach($as as $val){
          $tmp = array();
          $tmp['id'] = $val->id;
          $tmp['plat'] = $val->plat;
          $tmp['alarm_type'] = $val->alarm_type;
          $tmp['alarm_title'] = $val->alarm_title;
          $tmp['alarm_content'] = $val->alarm_content;
          $tmp['alarm_time'] = $val->alarm_time;
          $tmp['alarm_reason'] = $val->alarm_reason;
          $tmp['alarm_id'] = $val->alarm_id;
          $tmp['status'] = $val->status;
          $tmp['level'] = $val->level;
          $data['alarm'][] = $tmp;
      }
    $crition['condition'] = "`alarm_reason`=1";
    $unstable = AlarmState::model()->count($crition);
    $crition['condition'] = "`alarm_reason`=2";
    $wb = AlarmState::model()->count($crition);
    $crition['condition'] = "`alarm_reason`=3";
    $find = AlarmState::model()->count($crition);
    $crition['condition'] = "`alarm_reason`=4";
    $unfind = AlarmState::model()->count($crition);
    $all=$unstable+$wb+$find;
    if($all==0)
    {
     $data["unstable"]=0;
     $data["wb"]=0;
     $data["find"]=0;
    }
    else
    {
    $data["unstable"]=round($unstable/$all,4)*100;
    $data["wb"]=round($wb/$all,4)*100;
    $data["find"]=round($find/$all,4)*100;
    }
    if($find+$unfind==0)
    {
    $data["find2"]=0;
    $data["unfind"]=0;
    }
    else
    {
    $data["find2"]=round($find/$find+$unfind,4)*100;
    $data["unfind"]=round($unfind/$find+$unfind,4)*100;
    }
    $this->render('index',$data);
  }
  public function actionBugs($keyword="",$orderby="createdTime",$seq="desc",$page=1,$pagesize=10){
    $crition = array();
    $crition['order'] = "$orderby $seq";
    $pd= BugRecords::model()->page2($crition, $pagesize,$page);
    //var_dump($res);//exit;
    $data['count'] = $pd['count'];
    $data['page'] = $pd['page'];
    $data['pagenum'] = $pd['pagenum'];
    $data['offset'] = $pd['offset'];
    $data['bugs'] = $pd['list'];
    $data['seq'] = $seq; 
    $this->render('bugs', $data);
  }
  public function actionHandle($id){                                                                                                           
    $crition = array();
    $crition['condition'] = "`id`=$id";
    $as = AlarmState::model()->findAll($crition);
    $data = array();
    foreach($as as $val){
          $tmp = array();
          $tmp['id'] = $val->id;
          $tmp['plat'] = $val->plat;
          $tmp['alarm_type'] = $val->alarm_type;
          $tmp['alarm_title'] = $val->alarm_title;
          $tmp['alarm_content'] = $val->alarm_content;
          $tmp['alarm_time'] = $val->alarm_time;
          $tmp['alarm_reason'] = $val->alarm_reason;
          $tmp['alarm_id'] = $val->alarm_id;
          $tmp['status'] = $val->status;
          $tmp['level'] = $val->level;
          $data['alarm'][] = $tmp;
      }
    $this->render('handle',$data);                                                                                                          
  }
  public function actionHandled(){
    $id = $_POST['id'];
    $content = $_POST['content'];
    $reason = $_POST['reason'];
    $status = $_POST['state'];
    $level = $_POST['grade'];
    $crition = array();
    $crition['condition'] = "`id`=$id";
    $as = AlarmState::model()->findAll($crition);
    $as[0]->alarm_content = $content;
    $as[0]->alarm_reason = $reason;
    $as[0]->status = $status;
    $as[0]->level = $level;
    $as[0]->save();
    header('Location: index.php?r=requirement/index');
  }
	public function actionList()
	{
	    $this->layout="monitem2";
		$data['list'] = array();
		$pd = Requirement::model()->findAll(array("order"=>"id DESC"));
		if($pd) {
			$data['list'] = $pd;
		}
		$data['stateList'] = array(1=>"新建", 2=>"开发中", 3=>"已完成", 4=>"延后处理");
		$data['bgColorList'] = array(1=>"#349D59", 2=>"#DFD80C", 3=>"#225E67", 4=>"#999");
		$data['categoryList'] = array(1=>"平台展现", 2=>"校验策略", 3=>"统一回灌", 4=>"其它");
		$this->render('list', $data);
	}
  
  public function actionEmail()
  {
    $name = $_GET['name'];
    $proposer = $_GET['proposer'];
    $state = $_GET['state'];
    $updater = $_GET['updater'];
    
    $fopen = fopen('/home/work/ec_test_service/src/commands/requirementReport.txt', 'wb'); //新建文件
    fputs($fopen, "需求名称：".$name." \n");
    fputs($fopen,"申请人：".$proposer." \n");
	if($state==1)
    {fputs($fopen,"状态:新建 \n");}
	else if($state==2)
	{fputs($fopen,"状态:开发中 \n");}
	else if($state==3)
    {fputs($fopen,"状态:已完成 \n");}
	else
	{fputs($fopen,"状态:延后处理 \n");}
    fputs($fopen,"更新人：".$updater."\n");
    fputs($fopen, "链接请见http://pat.baidu.com/?r=requirement/list");
    fclose($fopen);
    $fp = fopen("/home/work/ec_test_service/config/warninglevel_requirement","wb"); //新建warning_level
    fputs($fp,"SEND_MSG_SH='/home/work/share/common/send_msg.sh'"." \n");
    fputs($fp,"MODULE_NAME='DATA-SAFE requierment description'"." \n");
    fputs($fp,"MAIL_MASTER='yangyanhong@baidu.com'"." \n");
    fputs($fp,"LEVEL_NUM=1"." \n");
    fputs($fp,"LEVEL_0_NAME='Stat'"." \n");
    fputs($fp,"LEVEL_0_MAILLIST='".$proposer."@baidu.com ".$updater."@baidu.com'"." \n");
    fputs($fp,"LEVEL_0_GSMLIST=''")." \n";
    fclose($fp);
    exec("sh /home/work/ec_test_service/src/commands/requirement_report.sh");
    header('Location: index.php?r=requirement/list');
  }

	public function actionSearch($keyword = "")
	{
		$pd = Requirement::model()->findAll("name like '%{$keyword}%'");
		if($pd) {
			$data['list'] = $pd;
		}
		$this->render('list', $data);
	}
	
	public function actionAlarmManage()
	{
		$data = array();
		$res = Alarmmanage::model()->findAll($crition);
		$data['res'] = $res;
		$this->render('alarm_manage',$data);
	}

	public function actionAlarmdeal()
	{
		$id = $_POST['id'];
		$msg_op = $_POST['msg_op'];
        $email_op = $_POST['email_op'];
        $alarm_deal = Alarmmanage::model()->find("id=:id",array(":id"=>$id));
        //如果操作和数据库中的一样，返回0
        if ($alarm_deal->msg_op == $msg_op && $alarm_deal->email_op==$email_op)
		{
			$this->json(0);
		}
        //如果短信操作和数据库中的不一样，返回1
		else if ($alarm_deal->email_op==$email_op && $alarm_deal->msg_op != $msg_op)
        {
            $alarm_deal->msg_op = $msg_op;
		    if ($alarm_deal->save())
		    {
                system("cd /home/work/sc-sitemap/tools/; sh warninglevel_manage.sh $msg_op $email_op $alarm_deal->monitor_case",$ret);
                if ($ret == -1 || $ret == -2)
                    $this->json(4);
                $this->json(1);
		    }
        }
        //如果邮件操作和数据库中的不一样，返回2
        else if ($alarm_deal->msg_op == $msg_op && $alarm_deal->email_op!=$email_op)
        {
            $alarm_deal->email_op = $email_op;
            if ($alarm_deal->save())
            {
                system("cd /home/work/sc-sitemap/tools/; sh warninglevel_manage.sh $msg_op $email_op $alarm_deal->monitor_case",$ret);
                if ($ret == -1 || $ret == -2)
                    $this->json(4);
                $this->json(2);
            }
        }
        //如果都不一样，返回3
		else
		{
            $this->json(3);
		}
	}
    
    public function actionCaseSet()
    {
        $crition = array();
        $crition['select'] = "id,case_name,descript,warnconfig_id,url,status, last_check_time";
        $res = CaseSet::model()->findAll($crition);
        $crition['select'] = 'monitor_case';
        $crition['condition'] = '`id`=:id';
        $data = array();
        foreach($res as $value) {
            $crition['params'] = array(':id'=>$value['warnconfig_id']);
            $res_warn_set = WarnconfigSet::model()->find($crition);
            $tmp = array();
            $tmp['id'] = $value['id'];
            $tmp['case_name'] = $value['case_name'];
            $tmp['descript'] = $value['descript'];
            $tmp['monitor_case'] = $res_warn_set['monitor_case'];
            $tmp['url'] = $value['url'];
            $tmp['status'] = $value['status'];
            $tmp['last_check_time'] = $value['last_check_time'];
            $data['caseset'][] = $tmp;
        }
        $this->render('caseset',$data);
    }

    public function actionWarnconfigSet()
    {
        $crition = array();
        $crition['select'] = "id,monitor_case,descript,msg_list,gmsg_list";
        $res = WarnconfigSet::model()->findAll($crition);
        $data = array();
        foreach ($res as $value)
        {
            $tmp = array();
            $tmp['id'] = $value['id'];
            $tmp['monitor_case'] = $value['monitor_case'];
            $tmp['descript'] = $value['descript'];
            $tmp['msg_list'] = $value['msg_list'];
            $tmp['gmsg_list'] = $vavlue['gmsg_list'];
            $data['warnconfigset'][] = $tmp;
        }
        //var_dump($data);exit();
        $this->render('warnconfigset',$data);
    }

    public function actionAddCaseSet()
    {
        $crition = array();
        $crition['select'] = '`id`,`monitor_case`';
        $warnconfigset = WarnconfigSet::model()->findAll($crition);
        $data = array();
        foreach ($warnconfigset as $item) {
            $tmp = array();
            $tmp['id'] = $item['id'];
            $tmp['monitor_case'] = $item['monitor_case'];
            $data['warnconfig_id'][] = $tmp;
        }
        $this->render('add_caseset', $data);
    }

    public function actionAddCaseSetItem()
    {
        $case_name = $_POST['case_name'];
        $case_descript = $_POST['descript'];
        $circle = $_POST['circle'];
        $product = $_POST['product'];
        $level = $_POST['level'];
        $warnconfig_id = $_POST['warnconfig_id'];
        $crontab_conf = $_POST['crontab_conf'];
        $module = $_POST['module'];
        $machine = $_POST['machine'];
        $url = $_POST['url'];
        $time_level = $_POST['time_level'];
        $data_source = $_POST['data_source'];
        $status_condition = $_POST['status_condition'];
        $warn_condition = $_POST['warn_condition'];
        $env = $_POST['env'];
        $create_time = time();
       
        $caseset = new CaseSet();
        $caseset->case_name = $case_name;
        $caseset->product = $product;
        $caseset->circle = $circle;
        $caseset->descript = $case_descript;
        $caseset->level = $level;
        $caseset->warnconfig_id = $warnconfig_id;
        $caseset->crontab_conf = $crontab_conf;
        $caseset->module = $module;
        $caseset->machine = $machine;
        $caseset->time_level = $time_level;
        $caseset->data_source = $data_source;
        if($status_condition){
            $caseset->status_condition = preg_replace('"','\"',$status_condition);
        }else{
            $caseset->status_condition = $status_condition;
        }
        
        /*$status_coondition = str_replace('"', '\"',$status_coondition);
        $caseset->status_condition = $status_coondition; 
        var_dump($status_coondition);
        */

        $caseset->warn_condition = $warn_condition;
        $caseset->url = $url;
        $caseset->create_time = $create_time;
        $caseset->env = $env;
        $caseset->save();
        $this->actionCaseSet();
    }

    public function actionAddWarnconfigSet()
    {
        $this->render('add_warnconfigset');
    }

    public function actionAddWarnconfigSetItem()
    {
        $warnconfigset = new WarnconfigSet();
        $monitor_case = $_POST['monitor_case'];
        $descript = $_POST['descript'];
        $warn_level = $_POST['warn_level'];
        $msg_list = $_POST['msg_list'];
        if ($_POST['gmsg_list']){
            $gmsg_list = $_POST['gmsg_list'];
        $warnconfigset->gmsg_list = $gmsg_list;
        }
        if($_POST['warn_merge']){
        $warn_merge = $_POST['warn_merge'];
        $warnconfigset->warn_merge = $warn_merge;
        }
        if($_POST['warn_merge_quit']){
        $warn_merge_quit = $_POST['warn_merge_quit'];
        $warnconfigset->warn_merge_quit = $warn_merge_quit;
        }
        if($_POST['warn_times']){
        $warn_times = $_POST['warn_times'];
        $warnconfigset->warn_times = $warn_times;
        }
        if($_POST['gwarn_merge']){
        $gwarn_merge = $_POST['gwarn_merge'];
        $warnconfigset->gwarn_merge = $gwarn_merge;
        }
        if($_POST['gwarn_merge_quit']){
        $gwarn_merge_quit = $_POST['gwarn_merge_quit'];
        $warnconfigset->gwarn_merge_quit = $gwarn_merge_quit;
        }
        if($gwarn_times = $_POST['gwarn_times']){
        $gwarn_times = $_POST['gwarn_times'];
        $warnconfigset->gwarn_times = $gwarn_times;
        }

        $warnconfigset->monitor_case = $monitor_case;
        $warnconfigset->descript = $descript;
        $warnconfigset->warn_level = $warn_level;
        $warnconfigset->msg_list = $msg_list;
        $warnconfigset->save();
        $this->actionWarnconfigSet();
    }

    public function actionGetCasesetItem()
    {
        $id = $_POST['id'];
        $caseset = CaseSet::model()->find("`id`=:id",array(":id"=>$id));
        if ($caseset) {
            $this->json(ActiveRecord::artoarray($caseset));
        }
        else {
            //为空的时候，返回0
            $this->json(0);
        }
    }
    
    public function actionGetWarnconfigsetItem()
    {
        $id = $_POST['id'];
        $warnconfigset = WarnconfigSet::model()->find("`id`=:id",array(":id"=>$id));
        if ($warnconfigset) {
            $this->json(ActiveRecord::artoarray($warnconfigset));
        }
        else {
            $this->json(0);
        }
    }

    public function actionSaveCasesetItem()
    {
        $crition = array();
        $crition['condition'] = "`id`=:id";
        $id = $_POST['id'];
        if (!$id) {
            throw new CHTTPException('404','The id transfered is null, contact QA to solve your problem.');
        }
        $crition['params'] = array(":id"=>$id);
        $caseset = CaseSet::model()->find($crition);
        $caseset->case_name = $_POST['case_name'];
        $caseset->product = $_POST['product'];
        $caseset->circle = $_POST['circle'];
        $caseset->descript = $_POST['descript'];
        $caseset->level = $_POST['level'];
        $caseset->warnconfig_id = $_POST['warnconfig_id'];
        $caseset->crontab_conf = $_POST['crontab_conf'];
        $caseset->module = $_POST['module'];
        $caseset->machine = $_POST['machine'];
        $caseset->time_level = $_POST['time_level'];
        $caseset->data_source = $_POST['data_source'];
        $caseset->status_condition = $_POST['status_condition'];
        $caseset->warn_condition = $_POST['warn_condition'];
        $caseset->env = $_POST['env'];
        $caseset->url = $_POST['url'];
        if ($caseset -> save()) {
            $this->json(1);
        }
        $this->json(0);
    }
   
    public function actionSaveWarnconfigsetItem()
    {
        $crition = array();
        $crition['condition'] = "`id`=:id";
        $id = $_POST['id'];
        if (!$id) {
            throw new CHTTPException('404','The id transfered is null, contact QA to solve your problem.');
        }
        $crition['params'] = array(":id"=>$id);
        $warnconfigset = WarnconfigSet::model()->find($crition);
        $warnconfigset->monitor_case = $_POST['monitor_case'];
        $warnconfigset->descript = $_POST['descript'];
        $warnconfigset->warn_level = $_POST['warn_level'];
        $warnconfigset->msg_list = $_POST['msg_list'];
        $warnconfigset->gmsg_list = $_POST['gmsg_list'];
        $warnconfigset->warn_merge = $_POST['warn_merge'];
        $warnconfigset->warn_merge_quit = $_POST['warn_merge_quit'];
        $warnconfigset->warn_times = $_POST['warn_times'];
        $warnconfigset->gwarn_merge = $_POST['gwarn_merge'];
        $warnconfigset->gwarn_merge_quit = $_POST['gwarn_merge_quit'];
        $warnconfigset->gwarn_times = $_POST['gwarn_times'];
        if ($warnconfigset->save())
        {
            $this->json(1);
        }
        $this->json(0);
    }

    public function actionRemoveCaseset() 
    {
        $id = $_POST['id'];
        if (!$id) {
            throw new CHTTPException('404','The id transfered is null, contact QA to solve your problem.');
        }
        $res = CaseSet::model()->deleteAll("`id`=:id",array(":id"=>$id));
        if ($res > 0) {
            $this->json(0);
        }
        else {
            $this->json(1);
        }
    }
    public function actionRemoveWarnconfigSet()                                                                                                                          
    {                                                                                                                                                              
        $id = $_POST['id'];                                                                                                                                        
        if (!$id) {                                                                                                                                                
            throw new CHTTPException('404','The id transfered is null, contact QA to solve your problem.');                                                        
        }                                                                                                                                                          
        $res = WarnconfigSet::model()->deleteAll("`id`=:id",array(":id"=>$id));                                                                                          
        if ($res > 0) {                                                                                                                                            
            $this->json(0);                                                                                                                                        
        }                                                                                                                                                          
        else {                                                                                                                                                     
            $this->json(1);                                                                                                                                        
        }                                                                                                                                                          
    } 
}
