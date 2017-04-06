<?php
/**
 * @file src/commands/BackendTaskCommand.php
 * @author yanglingling01(com@baidu.com)
 * @date 2014/02/27 12:16:06
 * @brief Backend Task Monitor
 *  
 **/

class ProductTargetCommand extends ConsoleCommand{
	  private static $std = [
											"pie_total_template_count" => "select count(*) as `number` from TBL_SD_TPL",
											"pie_added_template_count" => "select count(*) as `number` from TBL_SD_TPL where CREATE_TS>=:start_time and CREATE_TS<:end_time",
											"pie_total_template_user" => "select count(distinct USERID) as `number` from TBL_SD_TPL",
											"pie_total_task_count" => "select count(*) as `number` from TBL_MANAGE_TASK_INFO",
											"pie_added_task_count" => "select count(*) as `number` from TBL_MANAGE_TASK_INFO where SUBMIT_TIME>=:start_time and SUBMIT_TIME<:end_time",
											"pie_total_task_user" => "select count(distinct USER_NAME) as `number` from TBL_MANAGE_TASK_INFO",
											"pie_url_total_number" => "select sum(URL_TOTAL_NUM) as `number` from TBL_MANAGE_TASK_INFO",
											"pie_result_number" => "select sum(RESULT_NUM) as `number` from TBL_MANAGE_TASK_INFO"
									 ];
		private static $range = ["1" => "", "7" => "weekly", "30" => "monthly"];
	
		public function actionImportData($cycle=1, $base=0){
				if(!in_array($cycle, array_keys(self::$range))) exit("Invalid Cycle!\n");

        $time = time() - $base*86400;
				$end_time = date("Y-m-d 00:00:00", $time);
				$end = strtotime($end_time);
				$start_time = date("Y-m-d 00:00:00", $end - $cycle*86400);

				$dblink = Yii::app()->piedb;
			 
				$data = array();
				foreach(self::$std as $type => $sql){
						$tp = self::$range[$cycle]?($type."_".self::$range[$cycle]):$type;
						
						$tObj = CountType::model()->find(array("condition" => " `type`=:type ", "params" => array(":type" => $tp)));
						if(!$tObj){
								$tObj = new CountType;
								$tObj->type = $tp;
								$tObj->create_time = time();
								$tObj->save();
						}	
		
						$command = $dblink->createCommand($sql);
						$command->bindParam(":start_time", $start_time);
						$command->bindParam(":end_time", $end_time);
						$command->execute();
						$reader = $command->query();
					
						foreach($reader as $row){
							 $count = array_shift($row);
						}			

						$tmp = array();
						$tmp['tid'] = $tObj->id;
						$tmp['count'] = $count;						
						$tmp['ctime'] = $end - 86400;
						
						$data[] = $tmp;
				} 					
			 
				$this->insertData($data, "count_data");

			//	$this->insertUserCountType($dblink);
		}

		public function actionCountTypeUsers($base=0){
				$time = time() - $base*86400;
				$end = strtotime(date("Y-m-d 00:00:00", $time));
				
				$array = $this->getUserDetails();
				$dblink = Yii::app()->piedb;
				foreach($array as $type => $sql){
						$tid = CommonCountData::getTid($type);

						$command = $dblink->createCommand($sql);
						$command->execute();
						$reader = $command->query();

						$data = array();
						foreach($reader as $row){
							 	$username = $row['username'];

								$crit = array();
								$crit["condition"] = " `tid`=:tid and `username`=:username ";
								$crit["params"] = array(":tid" => $tid, ":username" => $username);
								$exists = CountTypeUsers::model()->exists($crit);
								if(!$exists){
										$tmp = array();
										$tmp["tid"] = $tid;
										$tmp["username"] = $username;
										$tmp["create_time"] = $end - 86400;
	
										$data[] = $tmp;
								}	
						}
						$this->insertData($data, "count_type_users");
				}
		}

		private function getUserDetails(){
				$array  = array();
				$array['pie_total_template_user'] = "select distinct USERID as `username` from TBL_SD_TPL";
				$array['pie_total_task_user'] = "select distinct USER_NAME as `username` from TBL_MANAGE_TASK_INFO";
		
				return $array;
		}

}
