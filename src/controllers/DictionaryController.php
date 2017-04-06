<?php
	class DictionaryController extends Controller
	{
		public $layout = "release";
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
			$username = Yii::app()->user->name; //gets loginuser
			$url = $chain->controller->id."/".$chain->action->id;
			POP::log("page", $url, $username);
			$chain->run();
		}
	
		public function actionIndex()
		{
			$data = array();
			$this->render("index",$data);
		}
		public function actionSubmit()
		{
			$data = array();
			$language = trim($_POST['language']);
		
			$method = trim($_POST['method']);
			$method = 0;
			if ($method ==0)
			{
				$source = trim($_POST['source']);
			}
			
			/*
			else if ($method ==1)
			{
				//deal with input_key  and value
				$tmp_key = trim($_POST['input_key']);
				$tmp_value = trim($_POST['input_value']);
				$var_key=explode("&",$tmp_key);
				$var_value=explode("&",$tmp_value);
				$source="";
				for ($i=0;$i< count($var_key);$i++)
				{
					$input_key[$i] = substr($var_key[$i],10);
					$input_value[$i] = substr($var_value[$i],12);
					
					$source_tmp= $input_key[$i].":".$input_value[$i]."&";
					$source .= $source_tmp;
				}
				$source = substr($source,0,strlen($source)-1); 	
			}*/
			$is_api=0;
			$dictionary_name = trim($_POST['dictionary_name']);
			$head = trim($_POST['head']);
			$reason = trim($_POST['reason']);
			$newold = trim($_POST['newold']);
			$memory = trim($_POST['memory']);
			$speed = trim($_POST['speed']);
			//$function_point = trim($_POST['function_point']);
			$user = Yii::app()->user->name;
			$time = date('Y-m-d_H:i:s', time());
			$status = 1;
			$pd = new dictionary();
			$pd->user = $user;
			$pd->time = $time;
			$pd->language = $language;
			$pd->source = $source;
			$pd->dictionary_name = $dictionary_name;
			$pd->newold = $newold;
			$pd->memory = $memory;
			$pd->speed = $speed;
			$pd->is_api = $is_api;
			//$pd->function_point = $function_point;
			$pd->status = $status;
			$pd->head = $head;
			$pd->reason = $reason;
			$pd->method = $method;
			if($pd->save()){
				$task_id = $pd->id;
				/****************command*****************/
				$DC_DICT_MACHINE="spider@cq7210";
				$DC_DICT_SCRIPT="/home/spider/platform_dc/script";
				$cmd="~/ci/lib/baselib/bin/go $DC_DICT_MACHINE 'cd $DC_DICT_SCRIPT;nohup sh dc_dict.sh -t $task_id &>$DC_DICT_SCRIPT/../log/$task_id &'";
				exec($cmd);
			
				$this->json(array('result' => 1,'task_id' => $task_id));
			}
			else{
				$this->json(array('result' => 0));
			}
				
		}

		public function actionDctestAPI()
		{
			$data = array();
			$language = $_GET['language'];
			$source = $_GET['source'];
			$dictionary_name = $_GET['dictionary_name'];
			$method = $_GET['method'];
			$newold = $_GET['newold'];
			$speed = $_GET['speed'];	
			$reason = $_GET['reason'];
			$head = $_GET['head'];
			$is_api = 1;
			//$function_point = $_GET['function_point'];
			$user = Yii::app()->user->name;
			$time = date('Y-m-d_H:i:s', time());
			$status = 1;
			$pd = new dictionary();
			$pd->user = $user;
			$pd->time = $time;
			$pd->language = $language;
			$pd->source = $source;
			$pd->dictionary_name = $dictionary_name;
			//$pd->function_point = $function_point;
			$pd->method = $method;
            //$pd->newold = $newold;
			$pd->newold = 1;
			$pd->speed = $speed;
			$pd->status = $status;
			$pd->head = $head;
			$pd->reason = $reason;
			$pd->is_api = $is_api;
			$cur_user = $head;
			$admins_conf = parse_ini_file(CONFIG."/dict_user.ini")[$dictionary_name];
			$admins = explode(",",$admins_conf);
			//Check the dictionary for machine check
			$machine_conf = parse_ini_file(CONFIG."/dict_machine.ini")['dicts'];
			$dicts_m = explode(",",$machine_conf);
			
			$machine_source = trim(shell_exec("echo $source |awk -F '://' '{print $2}' |awk -F '/' '{print $1}'"));
			
			if (!in_array($cur_user, $admins)){
				$result = "用户没有提交词典权限，请联系平台负责人";
				$this->json(array('result' => $result,'task_id' => $task_id));
			}elseif (in_array($dictionary_name, $dicts_m) && !in_array($machine_source, $admins)){
				$result = "machine没有提交词典权限，请联系平台负责人";
				$this->json(array('result' => $result,'task_id' => $task_id));
			}
			else{
				$pd->save();
				$task_id = $pd->id;
				/****************command*****************/
				$DC_DICT_MACHINE="spider@cq7210";
				$DC_DICT_SCRIPT="/home/spider/platform_dc/script";
				$cmd="~/ci/lib/baselib/bin/go $DC_DICT_MACHINE 'cd $DC_DICT_SCRIPT;nohup sh dc_dict.sh -t $task_id &>$DC_DICT_SCRIPT/../log/$task_id &'";
				exec($cmd);
				
				$this->json(array('result' => 1,'task_id' => $task_id));
			}
				
		}
/**************************DIFF*******************************************/
		public function actionDiffAPI()
		{
			$discription=$_POST["discription"];
        	$lang=$_GET["lang"];
        	$new_data_path=$_POST["new_path"];
        	$old_data_path=$_POST["old_path"];  
        	$time = date('Y-m-d H:i:s',time());
			$time1 = date('Y-m-d',time());
			
        	$user_name = "machine";
        	$diff_task = $this->saveDiffTask($time,$user_name,$discription,$lang,$new_data_path,$old_data_path,$time1);
			$diff_id =  $diff_task->diff_task_id;
			/****************command*****************/
			$result_path = "/home/work/platform_dc/diff/$time1/$diff_id";
        	$cmd = "mkdir -p $result_path;cd $DC_DICT_SCRIPT;nohup sh -x /home/work/ec_test_service/src/commands/make_diff.sh $new_data_path $old_data_path $diff_id $time1 2>$result_path/err 1>$result_path/log &";
        	exec($cmd);
        	echo $diff_id;			
			//$this->json(array('diff_task_id' => $diff_task->diff_task_id));
		}

		public function saveDiffTask($time,$user_name,$mission_description,$language,$new_input_path, $old_input_path,$time1)
    	{
			
        	$task = new DcDiffTaskList();
        	$task->time = $time;
        	$task->user = $user_name;
        	$task->host_name = "**";
        	$task->mission_description = $mission_description;
        	$task->language = $language;
        	$task->new_input_path = $new_input_path;
        	$task->old_input_path = $old_input_path;
        	$rc = $task->save();
        	if ($rc == false)
            	return null;
			
        	$task->log_path = "/home/work/platform_dc/diff/$time1/".strval($task->diff_task_id)."/err";
        	$rc = $task->save();
        	if ($rc == true)
            	return $task;
        	return null;
    	}
/********************Search Diff Task Statues API**************************/
		public function actionQueryTaskStatusAPI()
		{
			$id=$_GET["task_id"];
		
			$result=dictionary::model()->findByPk($id);
			//var_dump($result); exit;
			//echo $result->status;
			if(empty($result)) 
				$this->json(array('result' => 0,'status' => 'null'));
			else
				$this->json(array('result' => 1,'status' => $result->status));
			
		}
/**
  *curl "http://pat.baidu.com/?r=dictionary/dictTraceLastTimeAPI&key=del_reason:\[1-9\]"
*/
		public function actionDictTraceLastTimeAPI()
		{
			//echo json_encode(array('status' => 0,'result' => 'null'));
			$key=trim($_GET["key"]);
			$path_log = "/home/work/ec_test_service/script/dictrace/";
			$mathine = "cp01-qa-spider004.cp01.baidu.com";
			$cmd = "sh /home/work/ec_test_service/script/dictrace/get_list.sh '$key' 2>$path_log/viplist.txt";
			exec($cmd,$res,$value);
			if($value == 0)
			{
				$path_list = "ftp://" . $mathine . "/" . $path_log . "viplist.txt";
				$this->json(array('status' => 1,'result' => $path_list));
			}else{
				$this->json(array('status' => 2,'result' => 'null'));
			}
		}
		public function actionDicti18nTraceLastTimeAPI()
		{
			//echo json_encode(array('status' => 0,'result' => 'null'));
			$key=trim($_GET["key"]);
			$path_log = "/home/work/ec_test_service/script/dictrace/";
			$mathine = "cp01-qa-spider004.cp01.baidu.com";
			$cmd = "sh /home/work/ec_test_service/script/dictrace/get_list_i18n.sh '$key' 2>$path_log/viplist_i18n.txt";
			exec($cmd,$res,$value);
			if($value == 0)
			{
				$path_list = "ftp://" . $mathine . "/" . $path_log . "viplist_i18n.txt";
				$this->json(array('status' => 1,'result' => $path_list));
			}else{
				$this->json(array('status' => 2,'result' => 'null'));
			}
		}
		public function actionDictspimonTraceAPI()
		{
			//echo json_encode(array('status' => 0,'result' => 'null'));
			$key_encode=trim($_GET["key"]);
			$key=urldecode($key_encode);
			$start_d=trim($_GET["startday"]);
			$start_h=trim($_GET["starthour"]);
			$end_d=trim($_GET["endday"]);
			$end_h=trim($_GET["endhour"]);
			$path_log = "/home/work/ec_test_service/script/dictrace/";
			$mathine = "cp01-qa-spider004.cp01.baidu.com";
			$cmd = "sh /home/work/ec_test_service/script/dictrace/get_log_spimon.sh '$key' '$start_d $start_h' '$end_d $end_h' 2>$path_log/spimon.txt";
			//$cmd1= "echo $cmd >$path_log/spimon1.txt";
			//$cmd2= "echo $key >>$path_log/spimon1.txt";
			//exec($cmd1,$res,$value);
			//exec($cmd2,$res,$value);
			//echo $cmd;die;
			exec($cmd,$res,$value);
			if($value == 0)
			{
				$path_list = "ftp://" . $mathine . "/" . $path_log . "spimon.txt";
				$this->json(array('status' => 1,'result' => $path_list));
			}else{
				$this->json(array('status' => 2,'result' => 'null'));
			}
		}
		public function actionDictlzcTraceAPI()
		{
			//echo json_encode(array('status' => 0,'result' => 'null'));
			$key=trim($_GET["key"]);
			$start_d=trim($_GET["startday"]);
			$start_h=trim($_GET["starthour"]);
			$end_d=trim($_GET["endday"]);
			$end_h=trim($_GET["endhour"]);
			$path_log = "/home/work/ec_test_service/script/dictrace/";
			$mathine = "cp01-qa-spider004.cp01.baidu.com";
			$cmd = "sh /home/work/ec_test_service/script/dictrace/get_log_lzc.sh '$key' '$start_d $start_h' '$end_d $end_h' 2>$path_log/urllist_lzc.txt";
			//echo $cmd;die;
			exec($cmd,$res,$value);
			if($value == 0)
			{
				$path_list = "ftp://" . $mathine . "/" . $path_log . "urllist_lzc.txt";
				$this->json(array('status' => 1,'result' => $path_list));
			}else{
				$this->json(array('status' => 2,'result' => 'null'));
			}
		}

/********************Dictionary Task List**********************************/
		public function actionTask()
		{
			$data = array();
			//$result = dictionary::model()->findAll();
			$find_str = $_POST["find_str"];
			if($find_str)
			{
				//$result = dictionary::model()->findAll('id=:id', array(':id'=>$find_id));
				$result = dictionary::model()->findAll("dictionary_name like '%$find_str%' || user like '%$find_str%'");
			}
			else
			{
				$time = date('Y-m-d H:i:s',strtotime("-1 month"));
				$result = dictionary::model()->findAll('time>:time',array(':time'=>$time));
			}
			$data['result'] = $result;
			$this->render('dictionarylist',$data);
		}
/*****************状态改变************************/
		/*********************发邮件*********************/
        protected function sendMail($content, $subject, $receivers){
            $content = iconv('utf-8', 'GBK', $content);
            $subject= iconv('utf-8', 'GBK', $subject);
            $headers  = 'MIME-Version: 1.0' . "\r\n"; 
            $headers .= 'Content-type: text/html; charset=gbk' . "\r\n"; 
            $headers .= 'Cc: yangyanhong@baidu.com' . "\r\n";
			//var_dump($receivers);
            //$receivers = implode(',', $receivers);
            //使用工具sendMail发送邮件
            $ret = mail($receivers, $subject, $content, $headers);
            return $ret;
    
        }    
//存入版本数据库
		protected function versiontasksave($name,$id,$noah_id,$is_api)
		{
			if($name=="page_weight")
			{
				$task = new PageweightzwVersion();
                $task->distribute = "page_weight";
			}
			if($name=="page_extract")
			{
                $task = new Page_extractzwVersion();
                $task->distribute = "page_extract";
			}
			if($name=="MidWay")
			{
                $task = new MidwayzwVersion();
                $task->distribute = "MidWay";
			}
			if($name=="dc_filter")
			{
                $task = new Dc_filterzwVersion();
                $task->distribute = "dc_filter";
			}
			if($name=="CaseAnalysis")
			{
                $task = new CaseAnalysiszwVersion();
                $task->distribute = "CaseAnalysis";
			}
			if($name=="blacklist2_url")
			{
				$task = new Blacklist2urlzwVersion();
                $task->distribute = "black_list";
			}
			if($name=="vip_url")
			{
                $task = new Vip_urlzwVersion();
                $task->distribute = "vip_url";
			}
			if($name=="pcre")
			{
                $task = new PcrezwVersion();
                $task->distribute = "pcre";
			}
			if($name=="model_func")
			{
                $task = new Model_funczwVersion();
                $task->distribute = "model_func";
			}
			if($name=="translate")
			{
				$task = new TranslatezwVersion();
                $task->distribute = "translate";
			}
			if($name=="spamming_site")
			{
				$task = new Spamming_sitezwVersion();
                $task->distribute = "spamming";
			}
			if($name=="questionable_site")
			{
				$task = new Questionable_sitezwVersion();
                $task->distribute = "$name";
			}
			if($name=="pattern")
			{
				$task = new PatternzwVersion();
                $task->distribute = "$name";
			}
			if($name=="new_spamming")
			{
				$task = new New_spammingzwVersion();
                $task->distribute = "$name";
			}
			if($name=="mini_wdn_filter")
			{
				$task = new Mini_wdn_filterzwVersion();
                $task->distribute = "$name";
			}
			if($name=="innocent_url")
			{
				$task = new Innocent_urlzwVersion();
                $task->distribute = "$name";
			}
			if($name=="image_whitelist")
			{
				$task = new Image_whitelistzwVersion();
                $task->distribute = "$name";
			}
			if($name=="global_whitelist")
			{
				$task = new Global_whitelistzwVersion();
                $task->distribute = "$name";
			}
			if($name=="follow_link")
			{
				$task = new Follow_linkzwVersion();
                $task->distribute = "$name";
			}
			if($name=="follow_limit_create")
			{
				$task = new Follow_limit_createzwVersion();
                $task->distribute = "$name";
			}
			if($name=="follow_limit")
			{
				$task = new Follow_limitzwVersion();
                $task->distribute = "$name";
			}
			if($name=="dup_param")
			{
				$task = new Dup_paramzwVersion();
                $task->distribute = "$name";
			}
			if($name=="dup_domain")
			{
				$task = new Dup_domainzwVersion();
				$task->distribute = "$name";
			}
			if($name=="blacklist_url")
			{
				$task = new Blacklist_urlzwVersion();
                $task->distribute = "$name";
			}
			if($name=="attr_modify")
			{
				$task = new Attr_modifyzwVersion();
                $task->distribute = "$name";
			}
			if($name=="anchor_text")
			{
				$task = new Anchor_textzwVersion();
                $task->distribute = "$name";
			}
			if($name=="redir")
			{
				$task = new RedirVersion();
                $task->distribute = "$name";
			}
			if($name=="alias")
			{
				$task = new AliaVersion();
                $task->distribute = "$name";
			}
			if($name=="not_text")
			{
				$task = new NottextzwVersion();
                $task->distribute = "$name";
			}
            $time = date('Y-m-d H:i:s',time());
            $task->time = $time;
            $task->name = $name;
			if($is_api ==1)
			{
				$task->noah_id_online = $noah_id;
			}else
			{
				$task->noah_id = $noah_id;
			}
		    $task->task_id = $id;
            $task->ftp = "ftp://cp01-qa-spider004.cp01.baidu.com:/home/work/platform_dc/version/$name/$id/$name";
            $task->path = "../conf/$name";
            $task->save();
		}

		protected function versiontaskupate($name,$id,$noah_id)
		{
			if($name=="page_weight")
			{
				$task = new PageweightzwVersion();
			}
			if($name=="page_extract")
			{
                $task = new Page_extractzwVersion();
			}
			if($name=="MidWay")
			{
                $task = new MidwayzwVersion();
			}
			if($name=="dc_filter")
			{
                $task = new Dc_filterzwVersion();
			}
			if($name=="CaseAnalysis")
			{
                $task = new CaseAnalysiszwVersion();
			}
			if($name=="blacklist2_url")
			{
				$task = new Blacklist2urlzwVersion();
			}
			if($name=="vip_url")
			{
                $task = new Vip_urlzwVersion();
			}
			if($name=="pcre")
			{
                $task = new PcrezwVersion();
			}
			if($name=="model_func")
			{
                $task = new Model_funczwVersion();
			}
			if($name=="translate")
			{
				$task = new TranslatezwVersion();
			}
			if($name=="spamming_site")
			{
				$task = new Spamming_sitezwVersion();
			}
			if($name=="questionable_site")
			{
				$task = new Questionable_sitezwVersion();
			}
			if($name=="pattern")
			{
				$task = new PatternzwVersion();
			}
			if($name=="new_spamming")
			{
				$task = new New_spammingzwVersion();
			}
			if($name=="mini_wdn_filter")
			{
				$task = new Mini_wdn_filterzwVersion();
			}
			if($name=="innocent_url")
			{
				$task = new Innocent_urlzwVersion();
			}
			if($name=="image_whitelist")
			{
				$task = new Image_whitelistzwVersion();
			}
			if($name=="global_whitelist")
			{
				$task = new Global_whitelistzwVersion();
			}
			if($name=="follow_link")
			{
				$task = new Follow_linkzwVersion();
			}
			if($name=="follow_limit_create")
			{
				$task = new Follow_limit_createzwVersion();
			}
			if($name=="follow_limit")
			{
				$task = new Follow_limitzwVersion();
			}
			if($name=="dup_param")
			{
				$task = new Dup_paramzwVersion();
			}
			if($name=="dup_domain")
			{
				$task = new Dup_domainzwVersion();
			}
			if($name=="blacklist_url")
			{
				$task = new Blacklist_urlzwVersion();
			}
			if($name=="attr_modify")
			{
				$task = new Attr_modifyzwVersion();
			}
			if($name=="anchor_text")
			{
				$task = new Anchor_textzwVersion();
			}
			if($name=="redir")
			{
				$task = new RedirVersion();
			}
			if($name=="alias")
			{
				$task = new AliaVersion();
			}
			if($name=="not_text")
			{
				$task = new NottextzwVersion();
			}
            $attr = array(
            "noah_id_online" => $noah_id);
            $condition = 'task_id = :id';
            $params = array(
            ':id' => $id);
            $task->updateAll($attr, $condition, $params);;
		}
//保存状态前加逻辑
		function beforechangestatus($id,$before_status,$is_api,$after_status,$name,$result)
		{
			
			if ($before_status==2&&$after_status==3&&$is_api==1)
			{
                 //dict white list
				$dict_list=array("dup_param","pattern","model_func","redir","global_whitelist","attr_modify","alias","MidWay");
				if (in_array($name,$dict_list))
				{
                    $after_status=12;
					$DC_MACHINE="work@cp01-testing-ps6076.cp01.baidu.com";
					$code = dirname($result);
					$cmd="mkdir -p ~/platform_dc/version/$name/$id/;cd ~/platform_dc/version/$name/$id/;wget -r -nH --preserve-permissions --level=0 --cut-dirs=10 $code/tmp/new_dc_dict/";
					exec($cmd,$res,$value0);
					//push dict to data-safe
					$cmd_push="cd ~/platform_dc/version/$name/;rm -rf $name;wget -r -nH --preserve-permissions --level=0 --cut-dirs=10 $code/tmp/new_dc_dict/";
					exec($cmd_push,$res,$value1);
					if($value0 != 0 or $value1 !=0)
						return 8;
					/*$cmd_md5 = "date +%s >~/platform_dc/version/$name/$name.md5";
					exec($cmd_md5,$res,$valuemd5);
					if( $valuemd5 !=0 )
						return 8;*/
					$md5_path = "/home/work/platform_dc/version/".$name."/".$name.".md5";
					$myfile = fopen("$md5_path", "w") or die("Unable to open file!");
					$date_txt = time();
					$txt = "name=".$name."\n";
					fwrite($myfile, $txt);
					$txt = "id=".$name."_".$date_txt."\n";
					fwrite($myfile, $txt);
					$txt = "time=".$date_txt;
					fwrite($myfile, $txt);
					fclose($myfile);
					 
				}
				else
				{
				    return $this->beforechangestatus($id,2,1,11,$name,$result);
				}
			}
			
			if ($after_status==7)
			{
				//往版本管理里面插数据
				$DC_MACHINE="work@cp01-testing-ps6076.cp01.baidu.com";
				$code = dirname($result);
				$cmd = "mkdir -p ~/platform_dc/version/$name/$id/;cd ~/platform_dc/version/$name/$id/;wget -r -nH --preserve-permissions --level=0 --cut-dirs=10 $code/tmp/new_dc_dict/";
                exec($cmd,$res,$value0);
				//push dict to data-safe
				$cmd_push = "cd ~/platform_dc/version/$name/;rm -rf $name;wget -r -nH --preserve-permissions --level=0 --cut-dirs=10 $code/tmp/new_dc_dict/";
				exec($cmd_push,$res,$value1);
				//var_dump($cmd_push);die;
				if($value0 != 0 or $value1 != 0)
					return 8;
				//$cmd_md5 = "date +%s >~/platform_dc/version/$name/$name.md5";
				//exec($cmd_md5,$res,$valuemd5);
				//if( $valuemd5 !=0 )
				//	return 8;
				if ($name=="blacklist2_url")
				{
					
					$cmd_noah="noahdt serve /bj/spider/sandbox_blacklist2_url gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="vip_url")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_vip_url gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}

				if ($name=="translate")
				{
					//$cmd_noah="noahdt serve /bj/spider/dc_test_dict gko:///home/work/platform_dc/version/$name/$id/$name";
					$cmd_noah="noahdt serve /bj/spider/sandbox_translate_innocent_site gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="spamming_site")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_spamming gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="questionable_site")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_questionable_site gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="pattern")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_pattern gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="new_spamming")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_new_spamming gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="pcre")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_pcre gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="model_func")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_model_func gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="mini_wdn_filter")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_mini_wdn_filter gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="innocent_url")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_innocent_url gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="image_whitelist")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_image_whitelist gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="global_whitelist")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_global_whitelist gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="follow_link")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_follow_link gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="follow_limit_create")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_follow_limit_create gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="follow_limit")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_follow_limit gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="dup_param")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_dup_param gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="dup_domain")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_dup_domain gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="blacklist_url")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_blacklist_url gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="attr_modify")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_attr_modify gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="anchor_text")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_anchor_text gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="redir")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_redir gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="alias")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_dc_alias gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
				if ($name=="not_text")
				{
					$cmd_noah="noahdt serve /bj/spider/sandbox_not_text gko:///home/work/platform_dc/version/$name/$id/$name";
					exec($cmd_noah,$res,$value);
				}
                if ($name=="page_weight")
        	    {
                    $cmd_noah="noahdt serve /bj/spider/sandbox_page_weight gko:///home/work/platform_dc/version/$name/$id/$name";
                    //$cmd_noah="~/ci/lib/baselib/bin/go $DC_MACHINE 'noahdt serve /bj/spider/dc_test_dict gko:///home/work/platform_dc/version/$name/$id/$name'";
					exec($cmd_noah,$res,$value);
                }
                if ($name=="page_extract")
        	    {
                    $cmd_noah="noahdt serve /bj/spider/sandbox_page_extract gko:///home/work/platform_dc/version/$name/$id/$name";
                    //$cmd_noah="~/ci/lib/baselib/bin/go $DC_MACHINE 'noahdt serve /bj/spider/dc_test_dict gko:///home/work/platform_dc/version/$name/$id/$name'";
					exec($cmd_noah,$res,$value);
                }
                if ($name=="MidWay")
        	    {
                    $cmd_noah="noahdt serve /bj/spider/sandbox_mid_way gko:///home/work/platform_dc/version/$name/$id/$name";
                    //$cmd_noah="~/ci/lib/baselib/bin/go $DC_MACHINE 'noahdt serve /bj/spider/dc_test_dict gko:///home/work/platform_dc/version/$name/$id/$name'";
					exec($cmd_noah,$res,$value);
                }
                if ($name=="dc_filter")
        	    {
                    $cmd_noah="noahdt serve /bj/spider/sandbox_filter_rule gko:///home/work/platform_dc/version/$name/$id/$name";
                    //$cmd_noah="~/ci/lib/baselib/bin/go $DC_MACHINE 'noahdt serve /bj/spider/dc_test_dict gko:///home/work/platform_dc/version/$name/$id/$name'";
					exec($cmd_noah,$res,$value);
                }
                if ($name=="CaseAnalysis")
        	    {
                    $cmd_noah="noahdt serve /bj/spider/sandbox_case_analysis gko:///home/work/platform_dc/version/$name/$id/$name";
                    //$cmd_noah="~/ci/lib/baselib/bin/go $DC_MACHINE 'noahdt serve /bj/spider/dc_test_dict gko:///home/work/platform_dc/version/$name/$id/$name'";
					exec($cmd_noah,$res,$value);
                }
				if($value != 0)
				{
					return 8;
				}
				return 7;
			}
            if ($after_status==12)
			{
                $this->updatesandbox($id,$name) ;
				$status = $this->updatedatasafe($id,$name);
                return $status;  
            }

			return $after_status;
		}
		/*************
		   update md5 of dict for data-safe
		**************/
        function updatedatasafe($id,$name)
		{
			/*$cmd_md5 = "date +%s >~/platform_dc/version/$name/$name.md5";
			exec($cmd_md5,$res,$valuemd5);
			if( $valuemd5 !=0 )
				return 8;*/
			$md5_path = "/home/work/platform_dc/version/".$name."/".$name.".md5";
			$myfile = fopen("$md5_path", "w") or die("Unable to open file!");
			$date_txt = time();
			$txt = "name=".$name."\n";
			fwrite($myfile, $txt);
			$txt = "id=".$name."_".$date_txt."\n";
			fwrite($myfile, $txt);
			$txt = "time=".$date_txt;
			fwrite($myfile, $txt);
			fclose($myfile);
			return 12;
		}
		function updatesandbox($id,$name)
		{
			//往版本管理里面插数据
            $DC_MACHINE="work@cp01-testing-ps6076.cp01.baidu.com";
			if ($name=="alias")
			{
				$cmd_noah="noahdt serve /bj/spider/sandbox_dc_alias gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			if ($name=="redir")
			{
				$cmd_noah="noahdt serve /bj/spider/sandbox_redir gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			if ($name=="dup_param")
			{
				$cmd_noah="noahdt serve /bj/spider/sandbox_dup_param gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			if ($name=="dup_domain")
			{
				$cmd_noah="noahdt serve /bj/spider/sandbox_dup_domain gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			if ($name=="pattern")
			{
				$cmd_noah="noahdt serve /bj/spider/sandbox_pattern gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			if ($name=="model_func")
			{
				$cmd_noah="noahdt serve /bj/spider/sandbox_model_func gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			if ($name=="global_whitelist")
			{
				$cmd_noah="noahdt serve /bj/spider/sandbox_global_whitelist gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			if ($name=="MidWay")
			{
				$cmd_noah="noahdt serve /bj/spider/sandbox_mid_way gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			if ($name=="dc_filter")
			{
				$cmd_noah="noahdt serve /bj/spider/dc_filter_rule gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			if ($name=="blacklist2_url")
			{
				$cmd_noah="noahdt serve /bj/spider/sandbox_blacklist2_url gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			if ($name=="attr_modify")
			{
				$cmd_noah="noahdt serve /bj/spider/sandbox_attr_modify gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			/*if ($name=="pcre")
			{
				$cmd_noah="noahdt serve /bj/spider/dc_pcre -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			if ($name=="model_func")
			{
				$status = $this->filesizechange($id,$name,4956,4);
				if($status == 1)
					return 8;
				$cmd_noah="noahdt serve /bj/spider/DC_model_func -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
            if ($name=="spamming_site")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_spamming -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="blacklist_url")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_blacklist_url -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="anchor_text")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_anchor_test -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="attr_modify")
        	{
			    $cmd_noah="noahdt serve /bj/spider/DC_attr_modify -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="follow_limit")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_follow_limit -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="follow_limit_create")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_follow_limit_create -s -1 -u 50  gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="follow_link")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_follow_link -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="image_whitelist")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_image_whitelist -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="innocent_url")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_innocent_url -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="mini_wdn_filter")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_mini_wdn_filter -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="new_spamming")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_new_spamming -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="page_weight")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_page_weight -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="page_extract")
        	{
			    $cmd_noah="noahdt serve /bj/spider/page_extract -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="MidWay")
        	{
			    $cmd_noah="noahdt serve /bj/spider/mid_way -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="CaseAnalysis")
        	{
			    $cmd_noah="noahdt serve /bj/spider/case_analysis -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="pattern")
        	{
				$status = $this->filesizechange($id,$name,1284,4);
				if($status == 1)
					return 8;
			    $cmd_noah="noahdt serve /bj/spider/DC_pattern -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="questionable_site")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_questionable_site -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="translate")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_translat -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
				//$cmd_noah="noahdt serve /bj/spider/dc_test_dict gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
			//now the third people send dict

            if ($name=="alias")
        	{
				$status = $this->filesizechange($id,$name,2775992,15);
				//var_dump($status);die;
				if($status == 1)
					return 8;
			    $cmd_noah="noahdt serve /bj/spider/alias -s 7200 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="blacklist2_url")
        	{
				$status = $this->filesizechange($id,$name,34648,4);
				if($status == 1)
					return 8;
			    $cmd_noah="noahdt serve /bj/spider/blacklist2_url -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="vip_url")
        	{
			    $cmd_noah="noahdt serve /bj/spider/vip_url -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="redir")
        	{
				$status = $this->filesizechange($id,$name,52,4);
				if($status == 1)
					return 8;
			    $cmd_noah="noahdt serve /bj/spider/dc_redir -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
            if ($name=="not_text")
        	{
			    $cmd_noah="noahdt serve /bj/spider/dc_not_text -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
			if ($name=="dup_param")
			{
				$status = $this->filesizechange($id,$name,392276,2);
				if($status == 1)
					return 8;
				$cmd_noah="noahdt serve /bj/spider/dc_dup_param -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
			if ($name=="dup_domain")
			{
				$cmd_noah="noahdt serve /bj/spider/dc_dup_domain -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
				exec($cmd_noah,$res,$value);
			}
            if ($name=="global_whitelist")
        	{
				$status = $this->filesizechange($id,$name,12644,3);
				if($status == 1)
					return 8;
			    $cmd_noah="noahdt serve /bj/spider/DC_global_whitelist -s -1 -u 50 gko:///home/work/platform_dc/version/$name/$id/$name";
                exec($cmd_noah,$res,$value);
            }
			if($value != 0)
			{
				return 8;
			}
			return 12;*/

		}
		public function filesizechange($task_id,$name,$size,$number)
		{
			$common_size=$size;
			$common_number=$number;
			$common_change=0;
			$file_cmd="ls -l /home/work/platform_dc/version/$name/$task_id/$name |wc -l";
			exec($file_cmd,$res,$value);
			$file_number= $res[0];
			$file_cmd="ls -l /home/work/platform_dc/version/$name/$task_id/$name |head -1 |awk '{print $2}'";
			exec($file_cmd,$res1,$value);
			$file_size=$res1[0];
			if($file_size > $common_size)
			{
				    $common_change=($file_size-$common_size)/$common_size*100;
			}else
			{
				    $common_change=($common_size-$file_size)/$common_size*100;
			}
			if($common_change >10)
			{
				return 1;
			}
			return 0;
		}
//保存状态后进行逻辑---发邮件--根据改变完状态发
		public function afterchangestatus($task_id,$status,$user,$is_api,$name,$reason,$push_status)
		{
			if ($is_api == 1){
			    $dict_list=array("dup_param","pattern","model_func");
			    $dict_list_1=array("redir","alias");
				$dict_list_2=array("global_whitelist","attr_modify");
				$dict_list_3=array("MidWay");
			    if (in_array($name,$dict_list)){
				    $receivers="yangyanhong@baidu.com,huangwei16@baidu.com,liumengjia01@baidu.com";
				}else if (in_array($name,$dict_list_1)){
				    $receivers="yangyanhong@baidu.com,huangwei16@baidu.com,liumengjia01@baidu.com,liangzhongjie@baidu.com";
				}else if (in_array($name,$dict_list_2)){
					$receivers="yangyanhong@baidu.com,huangwei16@baidu.com,zhujianyu01@baidu.com,huyuanyuan@baidu.com";
				}else if(in_array($name,$dict_list_3)){
					$receivers="yangyanhong@baidu.com,huangwei16@baidu.com,liuwei11@baidu.com";
				}else{
                    $receivers="yangyanhong@baidu.com,huangwei16@baidu.com";
				}
			}else
				$receivers=$user."@baidu.com,yangyanhong@baidu.com,huangwei16@baidu.com,yezhiqin@baidu.com";
            if($status == 3)
                $content = "任务执行成功，请到 http://pat.baidu.com/?r=dictionary/task 进行下步操作";
            else if($status == 8)
                $content = "任务执行失败，请到http://pat.baidu.com/?r=dictionary/task  确认";
			else if($status == 13)
				$content = "词典文件大小超过预期范围,任务失败，请到http://pat.baidu.com/?r=dictionary/task  确认";
            else if($status == 14)
                $content = "推送noahdt失败，请到http://pat.baidu.com/?r=dictionary/task  确认";
			else if($status == 16) 
			{
			    //send message to op ----begin----
                $content_to_op = $name."已完成线上部署FROM 自动推送[DC模块]，请到http://pat.baidu.com/?r=dictionary/task  确认。修改原因:".$reason;
                $cmd_txt="echo  \"custom_send_grp_msg spiop_help adapter9527 1420409 $content_to_op \"  | nc yf-psop-deploy01.yf01 14440";
#$cmd_txt="echo  \"custom_send_grp_msg yyhsxl2011 840920 1466694 $content_to_op \"  | nc dbl-wise-vs-ios00.dbl01 14440";
				exec($cmd_txt,$res,$valueop);
                $cmd_txt_dc="echo  \"custom_send_grp_msg 杨彦红_eileen yangyh920 1429239 $content_to_op \"  | nc yf-psop-deploy01.yf01 14440";
				exec($cmd_txt_dc,$res,$valuedc);
			    $content = "已完成线上部署，请到http://pat.baidu.com/?r=dictionary/task  确认";
			}
            else if($status == 7 && $push_status == 1)
			{
			   //send mail to mangeer and excuter
                $receivers=$user."@baidu.com,yangyanhong@baidu.com,xurongqiang@baidu.com,tianzhenlei@baidu.com,jiangye@baidu.com";
			    //send message to op ----begin----
                $content_to_op = $name."已完成沙盒部署即将部署线上环境FROM 自动推送，请到http://pat.baidu.com/?r=dictionary/task  确认。修改原因：".$reason;
                $cmd_txt="echo  \"custom_send_grp_msg spiop_help adapter9527 1420409 $content_to_op \"  | nc dbl-wise-vs-ios00.dbl01 14440";
				$result=shell_exec($cmd_txt);
                $cmd_txt_dc="echo  \"custom_send_grp_msg spiop_help adapter9527 1429239 $content_to_op \"  | nc dbl-wise-vs-ios00.dbl01 14440";
				$result=shell_exec($cmd_txt_dc);
				//send message to op ----end----
                $content = "已完成沙盒部署即将部署线上环境请各位知晓FROM自动推送，请到http://pat.baidu.com/?r=dictionary/task  确认";
			}else
			    return 0; 
			$subject = $name."词典测试任务:".$task_id."状态通知";
			$this->sendMail($content, $subject, $receivers);
			//hi群通知
			$path_DS = "/home/work/ec_test_service/script/DictionaryState.py";
			$content_hi = $subject.$content;
			exec("python $path_DS $content_hi");
			//$this->sendHi($content, $receivers);
		}
		public function actionGetdataAPI(){
			//===GET NOAH STATUS===
			$data = trim($_POST['data']);
			if ($data == '')
			{
				return 0;
			}
			$group_id = 0;
			$status = 0;
			$instance_id = 0;
			$task_id = 0;
			$cmd = "mv /home/work/platform_dc/noah/noah.txt /home/work/platform_dc/noah/noah.txt.bak;echo $data > /home/work/platform_dc/noah/noah.txt";
			shell_exec($cmd);
			if ($value != 0)
			{
				return 0;
			}
			$cmd_status = "cat /home/work/platform_dc/noah/noah.txt|awk '{split($0,a,\"status:\");print a[2]}'|awk '{print $1}'";
			exec($cmd_status,$res,$value);
			$push_status = $res[0];
			if ($push_status == '')
			{
				return 0;
			}
			$cmd_taskid = "cat /home/work/platform_dc/noah/noah.txt|awk '{split($0,a,\"instanceId:\");print a[1]}' |awk -F '/' '{print $(NF)}'|awk -F '\' '{print $1}'";
			exec($cmd_taskid,$restask,$value);
			if ($value != 0)
			{
				return 0;
			}
			$task_name = $restask[0];
			if ($task_name == '')
			{
				return 0;
			}
			$cmd_noahid = "cat /home/work/platform_dc/noah/noah.txt|awk '{split($0,a,\"instanceId:\");print a[2]}' |awk '{print $1}'";
			exec($cmd_noahid,$resnoahid,$value);
			if ($value != 0)
			{
				return 0;
			}
			$instance_id =  $resnoahid[0];
			if ($instance_id == '')
			{
				return 0;
			}
			$cmd_groupid = "cat /home/work/platform_dc/noah/noah.txt|awk -F 'id:' '{split($2,a,\"]\");print a[1]}'";
			exec($cmd_groupid,$resgroupid,$value);
			if ($value != 0)
			{
				return 0;
			}
			$group_id = $resgroupid[0];
			if ($group_id == '')
			{
				return 0;
			}
			//===SAVE STATUS TO DATATABLE===
			$task_id = $this->gettaskid($task_name);
			if ($task_id == '')
			{
				return 0;
			}
			$task = dictionary::model()->findByPk($task_id);
			$before_status = $task->status;
			$name = $task->dictionary_name;
			$is_api = $task->is_api;
			$user = $task->user;
			$reason = $task->reason;
			$task->push_status ="http://noah.baidu.com/zeusweb-2/index.php?r=MachineQuery/MachineQuery&id=".$group_id;
			if ($push_status == 1 && $before_status == 7 )
			{
				$status = 7;//successed
			}else if ($push_status == 1 && $before_status == 15)
			{
				$status = 16;//successed online
			}else if ($push_status !=1)
			{
				$status = 17;//faild
			}
			$task->status = $status;
			
			$save_std = $task->save();
			if ($save_std == true)
			{
				$this->afterchangestatus($task_id,$status,$user,$is_api,$name,$reason,$push_status);
				//echo json_encode(['result' => 1,'task_id' => $task_id]);
			}else if ($save_std == false)
			{
				print_r($task->errors);
			}
			//===SAVER DICTIONARY TABLE====
			if ($before_status == 7)
			{
				$this->versiontasksave($name,$task_id,$instance_id,$is_api);
			}else if ($before_status == 15 && $is_api == 1)
			{
				$this->versiontasksave($name,$task_id,$instance_id,$is_api);
			}else if ($before_status == 15 && $is_api != 1)
			{
				$this->versiontaskupate($name,$task_id,$instance_id);
			}

			echo 1;
			return 1;
		}
		public function actionGetTaskDiffResultAPI(){
			$task_id = trim($_POST['id']);
			$diff_id = trim($_POST['diffid']);
			$diff_time = date('Y-m-d',time());
			//$diff_time = "2016-03-25";//test
			$base_path = "/home/work/platform_dc/diff/$diff_time/$diff_id";
			$cache_path1 = $base_path . "/diffcache/logdiff/Pack1.diff";
			$cache_path2 = $base_path . "/diffcache/logdiff/Pack2.diff";
			$saver_path = $base_path . "/diffsaver/diffpacket_result/summary";
			$save_std = 0;
		    $diff_cachepack1 = trim(shell_exec("cat $cache_path1|wc -l"));	
		    $diff_cachepack2 = trim(shell_exec("cat $cache_path2|wc -l"));	
			$saver_diff_pack = trim(shell_exec("grep diff_pack $saver_path |awk '{print $3}' |awk -F '=' '{print $2}'"));
			$saver_diff_pack1 = trim(shell_exec("grep diff_item $saver_path |awk '{print $8}' |awk -F '=' '{print $2}'"));
			if ($saver_diff_pack > 0){
				$links = trim(shell_exec("grep trespassing_field,spider,links $saver_path |awk '{print $2}'"));
				if ($saver_diff_pack > $links or $saver_diff_pack1 > 1){
					$task = dictionary::model()->findByPk($task_id);
					$task->status = 8;			
					$save_std = $task->save();
				}
			}
			if ($diff_cachepack1 > 0 or $diff_cachepack2 > 0){
				$task = dictionary::model()->findByPk($task_id);
				$task->status = 8;
				$save_std = $task->save();
			}
			echo $save_std;
			
		}
		public function actionChangeTaskStatusAPI(){
			
			$after_status = trim($_POST['status']);
			if($after_status == 13 or $after_status == 14 or $after_status == 15)
			{
				$dict_name = trim($_POST['dictname']);
				$task_id = $this->gettaskid($dict_name);
			}else
			{
				$task_id = trim($_POST['id']);
			}
			//保存状态前进行逻辑
			//保存状态
        	$task = dictionary::model()->findByPk($task_id);
			$is_api = $task->is_api;
			$before_status = $task->status;
			$user = $task->user;
			$name = $task->dictionary_name;
			$result = $task->result;
			$reason = $task->reason;
			$status=$this->beforechangestatus($task_id,$before_status,$is_api,$after_status,$name,$result);
            if (is_null($task))
        	{       
            	echo "find task failed"."\n";
            	return 0;
        	}
			//update status
			if($after_status == 13 or $after_status == 14 or $after_status == 15)
			{
				$task->status = $after_status;
			}
        	$task->status = $status;
        	$save_std = $task->save();
			$push_status = 0;
			if ($save_std == true)
        	{
                $this->afterchangestatus($task_id,$status,$user,$is_api,$name,$reason,$push_status);
                #$this->json(array('result' => 1,'task_id' => $task_id));
				echo json_encode(['result' => 1,'task_id' => $task_id]);
			}
			else if($save_std == false)
			{
				print_r($task->errors);
			}
		}
		public function gettaskid($dict_name)
		{
			$data = array();
			$result = dictionary::model()->findAll(array("condition" => "dictionary_name='$dict_name'  order by id desc limit 1"));
			$data = $result;
			if(!empty($data))
			{
				foreach ($data as $task)
				{
					$task_id = $task['id'];
				}
			}
			return $task_id;
		}
		
	}
?>
