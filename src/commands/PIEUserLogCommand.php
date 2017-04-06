<?php
/**
 * @file src/commands/BackendTaskCommand.php
 * @author yanglingling01(com@baidu.com)
 * @date 2014/03/03 20:16:06
 * @brief Backend Task Monitor
 *  
 **/

class PIEUserLogCommand extends ConsoleCommand{
	
		public function actionGetData($day){
				$cycle = 1;

        $time = time() - $day*86400;
				$end_time = date("Y-m-d 23:59:59", $time);
				$end = strtotime($end_time);
				$start_time = date("Y-m-d 00:00:00", $end);

				$crit = array();
				$crit["condition"] = " `LOGIN_TIME`>=:start_time and `LOGIN_TIME`<=:end_time ";	
				$crit["params"]	= array(":start_time" => $start_time, ":end_time" => $end_time);
				$data = TblStatisticRecord::model()->findAll($crit);
	
				$fp = fopen("/home/work/pop-plat/log/pie/log.".date("Ymd", $time), "w");
				$line = "";
				foreach($data as $dval){
					 $line .= $dval->USER_NAME."\t".$dval->CONTROLLER."/".$dval->ACTION."\t".strtotime($dval->LOGIN_TIME)."\n";
				}				

				fwrite($fp, $line);
				fclose($fp);
					 
		}

}
