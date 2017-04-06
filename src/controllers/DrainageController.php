<?php
	class DrainageController extends Controller
	{
		public $layout = "drainage";
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
			//引流中断的引流通道
			$tchs = parse_ini_file(CONFIG.'/drainage.ini', true)['type_channels'];
			$tchs = array_flip($tchs);
			$sh_path = "/home/work/ec_test_service/script/drainage/Drainage_break_warning.sh";
			$break_result1 = shell_exec("sh ".$sh_path);
			$break_result2 = explode("\n",$break_result1);
			$break_list = explode(" ",$break_result2[0]);
			$break_str="";
			foreach($break_list as $chn){
				$break_str = $tchs[$chn]."；".$break_str;
			}  
			$data['break']=$break_str;
			$data['info'] = Drainage::model()->findAll();
			$this->render("index",$data);
		}
		public function actionMonitor()
		{
			$type_channels = parse_ini_file(CONFIG."/drainage.ini");
			$active_items = Drainage::model()->findAll("end_t > :now", array(":now"=>date('Y-m-d H:i:s', time())));
			foreach($active_items as &$item) {
				$channel_name = $type_channels[$item['dtype']];
				if(isset($channel_name)) {
					$disp_name = $item['disp_name'];
					$cmd = "cd ../script/drainage && ./op.sh get_fifo $channel_name $disp_name";
					Yii::trace("get_info type:".$item['dtype'].", channel_name:$channel_name, disp_name:$disp_name", 'drainage');
					unset($output);
					exec($cmd, $output, $ret);
					if($ret == 0) {
						$item['fifos'] = $output;
					}
					else {
						foreach($output as $line) {
							Yii::trace('fifo:'.$line, 'drainage');
						}
					}
					$cmd = "cd ../script/drainage && ./op.sh get_sent $channel_name $disp_name";
					unset($output);
					exec($cmd, $output, $ret);
					if($ret == 0) {
						$item['sents'] = $output;
					}
					else {
						foreach($output as $line) {
							Yii::trace('sent:'.$line, 'drainage');
						}
					}
				}
				else {
					$item['fifos'] = array(-1);
					$item['sents'] = array(-1);
				}
			}
			unset($item);
			$data['info'] = $active_items;
			$this->render("monitor",$data);
		}
		public function actionSubmit()
		{
			$type_channels = parse_ini_file(CONFIG."/drainage.ini");
			$applicant = Yii::app()->user->name;
			$disp_name = $applicant.'_'.time();
			$dur_hour = trim($_POST['hour']);
			$dur_minute = trim($_POST['minute']);
			$dtype = trim($_POST['type']);
			$dest = trim($_POST['dest']);
			$port = trim($_POST['port']);
			$channel_name = $type_channels[$dtype];

			$dur_sec = $dur_hour * 3600 + $dur_minute * 60;
			$cmd = "cd ../script/drainage && ./drainage.sh $channel_name $disp_name $dest $port $dur_sec";
			$pid = exec($cmd, $output, $ret);
			if($ret != 0) {
				foreach($output as $line) {
					Yii::trace($line, 'drainage');
				}
				$this->json(array('result' => 0, 'res_info'=>"创建dispatcher失败"));
				return;
			}
			$start = date('Y-m-d H:i:s', time());
			$task = new Drainage();
			$task->pid = $pid;
			$task->disp_name = $disp_name;
			$task->applicant = $applicant;
			$task->dtype = $dtype;
			$task->start_t = $start;
			$task->dur_hour = $dur_hour;
			$task->dur_minute = $dur_minute;
			$task->destination = $dest;
			$task->port = $port;

			if($task->save()){
				$this->json(array('result' => 1,'task_id' => $task->pid));
			}
			else{
				$this->json(array('result' => 0));
			}
				
		}
		public function actionStop()
		{
			$id = trim($_POST['id']);
			$pid = Drainage::model()->findByPk($id)->pid;
			exec("kill $pid", $output, $ret);
			$now = date('Y-m-d H:i:s', time());
			$count = Drainage::model()->updateByPk($id, array('end_t'=>$now));
			if($count == 1) {
				$this->json(array('result'=>1, 'id'=>$id, 'pid'=>$pid));
			}
			else {
				$this->json(array('result'=>0));
			}
		}
		public function actionMail()
		{
			$id = $_GET['id'];
			$applicant = $_GET['applicant'];
			$dtype = $_GET['dtype'];
			$dest = $_GET['dest'];
			$port = $_GET['port'];
			$start_t = $_GET['start'];
			$fifo = $_GET['fifo'];
			$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
			$mailer->IsMail();
			$mailer->IsHTML(true);
			$mailer->CharSet = 'UTF-8';
			$mailer->From = 'psqa@baidu.com';
			$mailer->FromName = 'PSQA';
			$mailer->AddAddress("$applicant@baidu.com");
			$mailer->Subject = '引流拥堵报警';
			$filename = "../script/drainage/mail_template.html";
			$handle = fopen($filename, "rb");
			if( ! $handle) {
				$this->json(array('result'=>0, "res_info"=>"Can't find the file $filename"));
				exit(1);
			}
			$content = fread($handle, filesize($filename));
			fclose($handle);
			eval("\$body = \"$content\";");
			$mailer->Body = $body;
			if($mailer->Send()) {
//				$this->json(array('result'=>1));
				header('Location: ?r=drainage/monitor');
			}
			else {
				$this->json(array('result'=>0));
			}
		}

		public function actionDiffAPI()
		{
        	$diff_task = $this->saveDiffTask($time,$user_name,$discription,$lang,$new_data_path,$old_data_path,$time1);
		}

		public function saveDiffTask($time,$user_name,$mission_description,$language,$new_input_path, $old_input_path,$time1)
    	{
    	}
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

//保存状态前加逻辑
		function beforechangestatus($id,$before_status,$is_api,$after_status,$name,$result)
		{
			$cmd_noah="~/ci/lib/baselib/bin/go $DC_MACHINE 'noahdt serve /bj/spider/sandbox_blacklist2_url gko:///home/work/platform_dc/version/$name/$id/$name'";
			$cmd_noah="~/ci/lib/baselib/bin/go $DC_MACHINE 'noahdt serve /bj/spider/DC_global_whitelist -s -1 gko:///home/work/platform_dc/version/$name/$id/$name'";
		}
	}
?>
