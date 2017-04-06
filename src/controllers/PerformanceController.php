<?php
	class PerformanceController extends Controller
	{
		public $layout = "performance";
		public $num=2048;
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

		public function actionDiff()
		{
			$data = array();
			$this->render("diff",$data);
		}
		private function _insertToMain($task_name, $data_user, $comment, $data_remote_path, $data_remote_path_qps)
		{
			$sqlDetail ="insert into performance_main(task_name, data_user, comment, data_path, data_path_qps)"
						."values('"
						. $task_name."','"
						. $data_user."','"
						. $comment."','"
						. $data_remote_path."','"
						. $data_remote_path_qps."');";	
			$commandDetail = Yii::app()->db->createCommand($sqlDetail);

			$count_insert = $commandDetail->execute();


			$insert_id = Yii::app()->db->getLastInsertID();


			return array(
					"task_id"=>$insert_id,
					"record_count"=>$count_insert,
					""
					);

		}

		private function _insertToDetail($task_id, $time, $result, $local_path)
		{
			$sqlDetail ="insert into performance_detail(task_id, time, result_flag, result, local_path)"
						."values('"
						. $task_id."','"
						. $time."','"
						. "1"."','"
						. $result."','"
						. $local_path."');"	;
			$commandDetail = Yii::app()->db->createCommand($sqlDetail);

			$bool_result = $commandDetail->execute();

			return $bool_result;

		}

		//qps提交到数据库
		private function _insertToQps($task_id, $time, $result, $local_path)
		{
			$sqlQps ="insert into qpsperfdetail(task_id, time, result_flag, result, local_path)"
					."values('"
					. $task_id."','"
					. $time."','"
					. "1"."','"
					. $result."','"
					. $local_path."');" ;
			$commandQps = Yii::app()->db->createCommand($sqlQps);

			$bool_result = $commandQps->execute();

			return $bool_result;
		}
		private function _handlePerfData($data_remote_path, $data_method)
		{
			$local_base_dir = "/home/work/ec_test_service/script/performance";
			$local_data_dir = "/home/work/ec_test_service/script/performance/data_local";
	
			$data_analyze_tool = $local_base_dir."/pat_analysis.sh";

			if ($data_method == "ps_method") {
				$data_analyze_tool = $local_base_dir."/pat_analysis_ps.sh";
			}			
			if ($data_method == "pidstat_method") {
				$data_analyze_tool = $local_base_dir."/pat_analysis_pidstat.sh";
			}
			$file_actual_name = basename($data_remote_path);
			$current_data_in_sec = date('YmdHis');
			$target_file_name = $file_actual_name."_".$current_data_in_sec;

			$get_result_to_local_cmd =  "wget -r -nH --preserve-permissions ".$data_remote_path." -O ".$local_data_dir."/".$target_file_name;
	
			shell_exec($get_result_to_local_cmd);

			$result_output = shell_exec("sh ".$data_analyze_tool." ".$local_data_dir."/".$target_file_name);

			$result_perf = array();
			$result_list = explode("\n",$result_output);
			$virt_list = explode(" ",$result_list[0]);
			$res_list = explode(" ",$result_list[1]);
			$cpu_list = explode(" ",$result_list[2]);
			$result_perf["virt"] = "virt:max=".$virt_list[3].",min=".$virt_list[2].",avg=".$virt_list[1];
			$result_perf["res"] = "res:max=".$res_list[3].",min=".$res_list[2].",avg=".$res_list[1];
			$result_perf["cpu"] = "cpu:max=".$cpu_list[3].",min=".$cpu_list[2].",avg=".$cpu_list[1];
			
			return array(
				"local_path"=>$local_data_dir."/".$target_file_name,
				"result_final" => implode(";", $result_perf)
				);
		}

		//qps执行脚本
		private function _handleQpsData($data_remote_path)
		{
			$local_base_dir = "/home/work/ec_test_service/script/performance";
			$local_data_dir = "/home/work/ec_test_service/script/performance/data_local";

			$data_analyze_tool = $local_base_dir."/pat_analysis_qps.sh";
			$file_actual_name = basename($data_remote_path);
			$current_data_in_sec = date('YmdHis');
			$target_file_name = $file_actual_name."_".$current_data_in_sec;

			$get_result_to_local_cmd =  "wget -r -nH --preserve-permissions ".$data_remote_path." -O ".$local_data_dir."/".$target_file_name;
			shell_exec($get_result_to_local_cmd);
			
			$result_output = shell_exec("sh ".$data_analyze_tool." ".$local_data_dir."/".$target_file_name);

			$result_qps = array();
			$result_list = explode("\n",$result_output);
			$qps_list = explode(" ",$result_list[0]);
			$result_qps = "qps:max=".$qps_list[3].",min=".$qps_list[2].",avg=".$qps_list[1];
			
			return array(
				"local_path"=>$local_data_dir."/".$target_file_name,
				"result_final" => $result_qps
				);
		}

		public function actionSubmit()
		{
			$data_submit_info = array();


			$task_name = $_POST["task_name"];
			$data_path = $_POST["data_path"];
			#$data_path = preg_replace('/ /', '', $data_path1);
			#$data_path = trim($data_path1);
			#$data_path = str_replace(' ','',$data_path1);
			$data_path_qps = $_POST["data_path_qps"];
			$data_user = $_POST["data_user"];
			$comment = $_POST["comment"];
			$data_method = $_POST["data_method"];
			$task_time = date('Y-m-d H:i:s',time());
			//var_dump($task_name);
			//exit;
			if($data_path || $data_path_qps)
			{
				$ret_result = $this->_insertToMain($task_name, $data_user, $comment, $data_path, $data_path_qps);
				$task_id = $ret_result["task_id"];
			}
			
			if($data_path)
			{
				$handle_result = $this->_handlePerfData($data_path, $data_method);
				if(filesize($handle_result["local_path"]) != 0)
				{
				$local_target = $handle_result["local_path"];
				$result_final = $handle_result["result_final"];
				$result_insert_perf = $this->_insertToDetail($task_id, $task_time, $result_final, $local_target);
				}
			}
			if($data_path_qps)
			{
				//qps执行
				$handle_result_qps = $this->_handleQpsData($data_path_qps);
				if(filesize($handle_result_qps["local_path"]) != 0)
				{
				$local_target_qps = $handle_result_qps["local_path"];
				$result_final_qps = $handle_result_qps["result_final"];
				$result_insert_qps = $this->_insertToQps($task_id, $task_time, $result_final_qps, $local_target_qps);
				}
			}
			//qps执行结果存入数据库
			$data_submit_info = array();
			
			if ($result_insert_perf || $result_insert_qps)
			{	
				if($result_insert_perf && $result_insert_qps)
				{
					$data_submit_info["result"] = 3;
				}
				else if($result_insert_perf)
				{
					$data_submit_info["result"] = 2;
				}
				else
				{
					$data_submit_info["result"] = 1;
				}
				$data_submit_info["task_id"] = $task_id;
				if($result_insert_perf)
				{
					$data_submit_info["result_final"] = $result_final;
				}
				if($result_insert_qps)
				{
					$data_submit_info["result_final_qps"] = $result_final_qps;
				}
			}
			else 
			{
				$data_submit_info["result"] = -1;
			}
			//var_dump($task_name);exit;
			$this->json($data_submit_info);
			//var_dump($task_name);exit;
		}


		public function actionAPI()
		{
			$data_submit_info = array();

			$task_name = $_GET["task_name"];
			$data_path = $_GET["data_path"];
			$data_path_qps = $_GET["data_path_qps"];
			$data_user = $_GET["data_user"];
			$comment = $_GET["comment"];
			$data_method = $_GET["data_method"];
			$task_time = date('Y-m-d H:i:s',time());	
			//var_dump($data_path); exit;	
			if($data_path || $data_path_qps)
			{
				$ret_result = $this->_insertToMain($task_name, $data_user, $comment, $data_path, $data_path_qps);
				$task_id = $ret_result["task_id"];
			}
			
			if($data_path)
			{
				$handle_result = $this->_handlePerfData($data_path, $data_method);
				if(filesize($handle_result["local_path"]) != 0)
				{
				$local_target = $handle_result["local_path"];
				$result_final = $handle_result["result_final"];
				$result_insert_perf = $this->_insertToDetail($task_id, $task_time, $result_final, $local_target); 
				}
			}
			if($data_path_qps)
			{
				//qps执行
				$handle_result_qps = $this->_handleQpsData($data_path_qps);
				if(filesize($handle_result_qps["local_path"]) != 0)
				{
				$local_target_qps = $handle_result_qps["local_path"];
				$result_final_qps = $handle_result_qps["result_final"];
				$result_insert_qps = $this->_insertToQps($task_id, $task_time, $result_final_qps, $local_target_qps);
				}
			}
			//qps执行结果存入数据库
			$data_submit_info = array();
			
			if ($result_insert_perf || $result_insert_qps)
			{	
				$data_submit_info["result"] = 1;
				$data_submit_info["task_id"] = $task_id;
				if($result_insert_perf)
				{
					$data_submit_info["result_final"] = $result_final;
				}
				if($result_insert_qps)
				{
					$data_submit_info["result_final_qps"] = $result_final_qps;
				}
			}
			else
			{
				$data_submit_info["result"] = "The address of the task isn't exist or the machine doesn't support wget command!";
			}
			$this->json($data_submit_info);
		}
		
		
		private function _handlediffdetail($task1_id,$task2_id)
		{
			$data1 = $this->_handleDetail($task1_id);
			$data2 = $this->_handleDetail($task2_id);
			$perf1 = $data1["performances"];
			$perf2 = $data2["performances"];
			$perfdiff = array();
			$unit_g = "g";
			$unit_m = "m";
			
			$diffresult = array();
			$diffjson = array();
			
			foreach($perf2 as $perf_key1=>$perf_key){
				foreach($perf_key as $perf_key2=>$perf2_val){
					$perf1_val = $perf1[$perf_key1][$perf_key2];
					
					if(strpos($perf1_val,$unit_g)){
						$perf1_val = (floatval(substr($perf1_val,0,-1)))*1024*1024;
					}
					else if(strpos($perf1_val,$unit_m)){
						$perf1_val = (floatval(substr($perf1_val,0,-1)))*1024;
					}
					if(strpos($perf2_val,$unit_g)){
						$perf2_val = (floatval(substr($perf2_val,0,-1)))*1024*1024;
					}
					else if(strpos($perf2_val,$unit_m)){
						$perf2_val = (floatval(substr($perf2_val,0,-1)))*1024;
					}
					if($perf2_val==0){
						$perfdiff[$perf_key1][$perf_key2]="data is zero";
					}
					else{
						$perfdiff[$perf_key1][$perf_key2] = round(($perf1_val-$perf2_val)/$perf2_val*100,2).'%';
					}
					$diffresult[$perf_key1.$perf_key2] = array($perf2_val,$perf1_val,$perfdiff[$perf_key1][$perf_key2]);
				}
			}	

			$diffjson["task1_id"] = $task1_id;
			$diffjson["task2_id"] = $task2_id;
			$diffjson["name"] = array("old","new","diff");
			$diffjson["diffresult"] = $diffresult;
			$data["diffjson"] = $diffjson;
						
			$data["performances"] = $perfdiff;
			$data["performances_name"] = $data1["performances_name"];
			$data["local_path1"] = $data1["local_path"];
			$data["local_path2"] = $data2["local_path"];
			$data["data_path1"] = $data1["data_path"];
			$data["data_path2"] = $data2["data_path"];
			$data["task_name"] = "diff——".$task1_id.",".$task2_id;
			$data["task1_id"] = $task1_id;
			$data["task2_id"] = $task2_id;
			return $data;
		}
		public function actiondiffAPI()
		{
			$task1_id = $_GET["task1_id"];
			$task2_id = $_GET["task2_id"];
			$data = $this->_handlediffdetail($task1_id,$task2_id);
			$this->json($data["diffjson"]);
			$this->render('diffdetail',$data);
		}

		public function actiondiffSubmit()
		{
			$task1_id = $_POST["task1_id"];
			$task2_id = $_POST["task2_id"];
			$data = $this->_handlediffdetail($task1_id,$task2_id);
			$this->render('diffdetail',$data);
		}
		
		public function actiondiffchart(){
			$local_path1 = $_POST["local_path1"];
			$local_path2 = $_POST["local_path2"];
			$data1 = $this->_handleFiledata($local_path1);
			$data2 = $this->_handleFiledata($local_path2);
			$data = array();
			$data["data1"] = $data1;
			$data["data2"] = $data2;
			$this->json($data);
		}

		

		//qps结果页面
		public function actionQpsTask()
		{	
			$data = array();
			$find_str = $_POST["find_str"];
			if($find_str)
			{
				//$result = qpsperfdetail::model()->with('qpsmain')->findAll("qpsmain.task_id=:find_id", array(':find_id'=>$find_id));
				$result = qpsperfdetail::model()->with('qpsmain')->findAll("qpsmain.task_name like '%$find_str%' || qpsmain.data_user like '%$find_str%'");
			}
			else
			{
				$time = date('Y-m-d H:i:s',strtotime("-1 month"));
				$result = qpsperfdetail::model()->with('qpsmain')->findAll('time>:time',array(':time'=>$time));
			}
			$data['result'] = $result;
			$this->render('qpsperflist',$data);			
		}

		//qps绘图结果页面
		public function actionQpsDetail(){
			$task_id = $_GET["taskid"];
			$data = array();
			$record=qpsperfdetail::model()->find('task_id=:task_id', array(':task_id'=>$task_id));
			$performances = array();
			$performances_name = array();
			$arr1 = explode(":",$record->result);//qps+结果
			$arr2 = explode(",",$arr1[1]);//
			foreach($arr2 as $u2){
				$arr3 = explode("=",$u2);//0为max，1为数字
				$performances[$arr1[0]][$arr3[0]] = $arr3[1];
			}
			array_push($performances_name,$arr1[0]);
			$data["performances"] = $performances;
			$data["performances_name"] = $performances_name;//qps
			$data["local_path"] = $record->local_path;
			$data["data_path"] = $record->data_path;
			$record_main=PerformanceMain::model()->find('task_id=:task_id', array(':task_id'=>$task_id));
			$task_name = $record_main->task_name;
			$data["task_name"] = $task_name;
			$this->render('qpsdetail',$data);
		}
		//qps图标页面	
		public function actionQpsFiledata(){
			$local_path = $_POST["local_path"];
			// if(empty($local_path) || !file_exists($local_path)){
			// 	$data_path = $_POST["data_path"];
			// 	$command = "get hadoop data--www12 ";
			// 	$local_path = shell_exec($command);
			// }
			if(empty($local_path) || !file_exists($local_path)){
				$this->json(1);
			}
			$handle = fopen($local_path, 'r');
			$k=0;
			$data = array();
			$file_data = array();
			$unit_data = array();
			while(!feof($handle)){
				$line = fgets($handle, $this->num);
				$line = str_replace(array("\r\n", "\r", "\n"), "", $line);
				$arr_data = explode(" ", $line);
				$len = count($arr_data);
				//根据第一行内容来判断具体有哪些性能指标(第一列为时间，其余列为性能指标)
				if($k == 0){
					$performances = $arr_data;
					$data['performances'] = $arr_data;
				}else if($len > 1){
					$single_data = array();
					for($i = 0; $i < $len; $i++){
						$detailData = $arr_data[$i];
						//部分数据可能不是纯数字，获取最后一位作为单位
						$unit = substr($detailData,strlen($detailData)-1,1);
						if(is_numeric($unit)){
							$unit = "";
						}else{
							$detailData = substr($detailData,0,strlen($detailData)-1);
						}
						
						$single_data[$performances[$i]] = $detailData;

						if($k==1){
							$unit_data[$performances[$i]] = $unit;
						}
					}
					array_push($file_data,$single_data);
				}
				$k++;
			}
			fclose($handle);
			$data['performanceData'] = $file_data;
			$data['unit_data'] = $unit_data;
			$this->json($data);
		}
		//性能mem、cpu结果页面
		public function actionTask()
		{
			$data = array();
			//$result = PerformanceMain::model()->with('performance_detail')->findAll();
			$find_str = $_POST["find_str"];
			if($find_str)
			{
				$result = PerformanceDetail::model()->with('performance_main')->findAll("performance_main.task_name like '%$find_str%' || performance_main.data_user like '%$find_str%'");
			}
			else
			{
				$time = date('Y-m-d H:i:s',strtotime("-1 month"));
				$result = PerformanceDetail::model()->with('performance_main')->findAll('time>:time',array(':time'=>$time));
			}
			$data['result'] = $result;
			$this->render('performnacelist',$data);
		}

		public function actionDetail(){
		    $task_id = $_GET["taskid"];
			$data = $this->_handledetail($task_id);
			$this->render('detail',$data);
		}
		private function _handledetail($task_id){
			$data = array();
			$record=PerformanceDetail::model()->find('task_id=:task_id', array(':task_id'=>$task_id));
			$performances = array();
			$performances_name = array();
			$arr = explode(";",$record->result);
			foreach($arr as $u){
				$performances_count++;
				$arr1 = explode(":",$u);
				$arr2 = explode(",",$arr1[1]);
				foreach($arr2 as $u2){
					$arr3 = explode("=",$u2);
					$performances[$arr1[0]][$arr3[0]] = $arr3[1];
				}
				array_push($performances_name,$arr1[0]);
			}
			$data["performances"] = $performances;
			$data["performances_name"] = $performances_name;
			$data["local_path"] = $record->local_path;
			$data["data_path"] = $record->data_path;
			$record_main=PerformanceMain::model()->find('task_id=:task_id', array(':task_id'=>$task_id));
			$task_name = $record_main->task_name;
			$data["task_name"] = $task_name;
			//$this->render('detail',$data);
			return $data;
		}

		public function actionFiledata(){
			$local_path = $_POST["local_path"];
			$data = $this->_handlefiledata($local_path);
			$this->json($data);
		}
			
		private function _handlefiledata($local_path){
			$data_sample_tool = "/home/work/ec_test_service/script/performance/data_sample_tool.sh";
			if(empty($local_path) || !file_exists($local_path)){
				//$this->json(1);
				return 1; 
			}
			shell_exec("sh ".$data_sample_tool." ".$local_path);
			$handle = fopen($local_path, 'r');
			$k=0;
			$data = array();
			$file_data = array();
			$unit_data = array();
			while(!feof($handle)){
				$line = fgets($handle, $this->num);
				$line = str_replace(array("\r\n", "\r", "\n"), "", $line);
				$arr_data = explode(" ", $line);
				$len = count($arr_data);
				//根据第一行内容来判断具体有哪些性能指标(第一列为时间，其余列为性能指标)
				if($k == 0){
					$performances = $arr_data;
					$data['performances'] = $arr_data;
				}else if($len > 1){
					$single_data = array();
					for($i = 0; $i < $len; $i++){
						$detailData = $arr_data[$i];
						//部分数据可能不是纯数字，获取最后一位作为单位
						$unit = substr($detailData,strlen($detailData)-1,1);
						if(is_numeric($unit)){
							$unit = "";
						}else{
							$detailData = substr($detailData,0,strlen($detailData)-1);
						}
						
						$single_data[$performances[$i]] = $detailData;

						if($k==1){
							$unit_data[$performances[$i]] = $unit;
						}
					}
					array_push($file_data,$single_data);
				}
				$k++;
			}
			fclose($handle);
			$data['performanceData'] = $file_data;
			$data['unit_data'] = $unit_data;
			//$this->json($data);
			return $data;
		}
		
	}
?>
