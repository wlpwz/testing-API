<?php
/**
 * @file src/commands/BackendTaskCommand.php
 * @author yanglingling01(com@baidu.com)
 * @date 2014/03/19 20:16:06
 * @brief Backend Task Monitor
 *  
 **/

class DatawareLogCommand extends ConsoleCommand{
		static private $server = "db-spi-webdata0.db01.baidu.com";
		static private $path = "/home/work/project/dataware/yii/webroot/protected/runtime";	
		static private $output = "/home/work/pop-plat/log/dataware";

		public function actionGetData($day){
				$cycle = 1;

        $time = time() - $day*86400;
				$date = date("Ymd", $time);
				$file = "access.log".$date;
				$newfile = "access.log.new.".$date;

				$output = $this->dumpPromotLog(self::$server, self::$path, $file);

				$fp = fopen($output, "r");
				$fn = fopen(self::$output."/".self::$server.".{$newfile}", "a");
				while(!feof($fp)){
					 $line = fgets($fp);
           $line = rtrim($line);
           if(empty($line)) continue;

					 $pattern = "/([0-9]{4}\/[0-9]{2}\/[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}) \[access\] \[access\] (.*)/";
					 if(preg_match_all($pattern, $line, $matches)){
								$time = $matches[1][0];
								$details = json_decode($matches[2][0], true);
	
								$url = array_shift(explode("?", $details['url']));							
								$newLine = $details['user']."\t".$url."\t".strtotime($time)."\n";
								fwrite($fn, $newLine);
						}	
				}
				fclose($fp);
				fclose($fn);
		}

	  protected function dumpPromotLog($server, $path, $file){
        $output = self::$output."/{$server}.{$file}";
        exec("wget -O {$output}  ftp://{$server}{$path}/{$file}&", $info);

        return $output;
		}



}
