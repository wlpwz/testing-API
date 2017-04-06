<?php
/**
 * @file src/commands/BackendTaskCommand.php
 * @author yanglingling01(com@baidu.com)
 * @date 2014/02/27 12:16:06
 * @brief Backend Task Monitor
 *  
 **/

class BackendTaskCommand extends ConsoleCommand{
		private $step = [
											"get_url_list",
										  "crawl_page",
											"crawl_page_extract",
											"data_extract",
											"stat_task",
											"store_task",
										];

		private $step_need_total = ["get_url_list","crawl_page"];

	  private $std = [
											"cost_time",
											"fail_rec_number",
											"total_rec_number",
											"total_task_count",
											"max_cost_time",
											"min_cost_time",
											"maxtime_data_size",
											"mintime_data_size"
									 ];
	
		public function actionImportData($cycle){
        $time = time();
				if($cycle < 60){
						$end = strtotime(date("Y-m-d H:i:00", $time));
				}elseif($cycle < 1440){
						$end = strtotime(date("Y-m-d H:00:00", $time));
				}else{
						$end = strtotime(date("Y-m-d 00:00:00", $time));
				}
				$start = $end - $cycle*60;
				$start_time = date("Y-m-d H:i:s", $start);
				$end_time = date("Y-m-d H:i:s", $end);

				//构造获取条件
				$crit = array();
				$crit["condition"] = " `RECORD_TIME`>=:start_time and `RECORD_TIME`<=:end_time ";
				$crit["params"] = array(":start_time" => $start_time, ":end_time" => $end_time);

				$max = $min =  $succount =  $tasks = array();
				$result = $this->_initArray();
				$success = TblTaskStepCost::model()->findAll($crit);
				$fail = TblTaskFailReason::model()->findAll($crit);
				if($success){
						foreach($success as $sval){
								if(in_array($sval->STEP, $this->step)){
											if(!isset($succount[$sval->STEP])) $succount[$sval->STEP] = 0;
											$succount[$sval->STEP] ++;

											$result[$sval->STEP]["cost_time"] += $sval->COST_TIME;
											$result[$sval->STEP]["total_rec_number"] += 1;
											$tasks[$sval->STEP][] = $sval->TASK_ID;

											//计算最大值及最小值
											if(!isset($max[$sval->STEP])){ 
														$max[$sval->STEP] = array("task_id" => 0, "cost_time" => 0);
														$min[$sval->STEP] = array("task_id" => $sval->TASK_ID, "cost_time" => $sval->COST_TIME);
											}
											if($sval->COST_TIME>=$max[$sval->STEP]["cost_time"])
														$max[$sval->STEP] = array("task_id" => $sval->TASK_ID, "cost_time" => $sval->COST_TIME);
											if($sval->COST_TIME<$min[$sval->STEP]["cost_time"])
														$min[$sval->STEP] = array("task_id" => $sval->TASK_ID, "cost_time" => $sval->COST_TIME);
								}	
						}

						//最大值与最小值分析
       			if($max){
            		foreach($max as $stp => $sval){ 
                		$result[$stp]['max_cost_time'] = $sval['cost_time'];
                		$result[$stp]['min_cost_time'] = $min[$stp]['cost_time'];
         
                		$infMax = TblManageTaskInfo::model()->findByPk($sval['task_id']);
                		$infMin = TblManageTaskInfo::model()->findByPk($min[$stp]['task_id']);
                		//前2个处理过程取URL_TOTAL_NUM，其他过程取RESULT_NUM
                		if(in_array($stp, $this->step_need_total)){
                    		$result[$stp]['maxtime_data_size'] = $infMax->URL_TOTAL_NUM;
                    		$result[$stp]['mintime_data_size'] = $infMin->URL_TOTAL_NUM;
                		}else{  
                    		$result[$stp]['maxtime_data_size'] = $infMax->RESULT_NUM;
                    		$result[$stp]['mintime_data_size'] = $infMin->RESULT_NUM;
                		}       
            		}       
      			} 
				}
				if($fail){
				    foreach($fail as $fval){
						    if(in_array($fval->FAIL_STEP, $this->step)){
								     $result[$fval->FAIL_STEP]["fail_rec_number"] += 1;
										 $result[$fval->FAIL_STEP]["total_rec_number"] += 1;
										 $tasks[$fval->FAIL_STEP][] = $fval->TASK_ID;
								}
						}
				}

			 $data = array();
			 foreach($result as $mstep => $mv){
			      foreach($mv as $mkey => $mval){
						    $type = $mstep."|".$mkey;
							  $tmp = array();
								$tmp["tid"]	= $this->getTid($type);
								if($mkey == "cost_time"){
									 //$number = count($tasks[$mstep]);
										$number = $succount[$mstep];
										$tmp["count"] = $number?round($mval/$number, 2):0;
								}elseif($mkey == "total_task_count"){
										if(isset($tasks[$mstep])){
										    $tsk_count = count(array_unique($tasks[$mstep]));
										}else{
												$tsk_count = 0;
										}
										$tmp["count"] = $tsk_count;
								}else{
										$tmp["count"] = $mval;
								}
								$tmp["ctime"] = $start;
								$data[] = $tmp;
						} 
			 }
			
			 $this->insertData($data, "count_data");
		}

		protected function getTid($type){
				$exist = CountType::model()->find(array("condition" => " `type`=:type ", "params" => array(":type" => $type)));
				if(!$exist){
						$exist = new CountType;
						$exist->type = $type;
						$exist->create_time = time();
						$exist->save();
				}

				return $exist->id;
		}

		protected function _initArray(){
				$data = array();

				foreach($this->step as $s){
				    if(!isset($data[$s])) 
						    $data[$s] = array();
						foreach($this->std as $label)
								$data[$s][$label] = 0;						
				}

				return $data;
		}

}
