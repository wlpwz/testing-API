<?php
/**
 * @file src/commands/ProductMonitorCommand.php
 * @author yanglingling01(com@baidu.com)
 * @date 2014/03/18 16:16:06
 * @brief DB Monitor 
 *  
 **/

class ProductMonitorCommand extends ConsoleCommand{
		private static $fields = ["daily", "weekly", "monthly"];

		public function actionExecute($cyc = "daily", $base=0){
				if (!in_array($cyc, self::$fields)){
						exit("Invalid Cycle!\n");
				}
				//时间对比只支持年月日时分秒格式
				$timeRange = $this->getTimeRange($cyc, $base);

				//获取监控状态为1，且$cyc为1的监控项
				$condition = " `stat`=1 and `{$cyc}`=1 ";
				$configs =  ConfigMondb::model()->findAll( $condition );
				if( empty($configs) ){
						exit("No Configs!\n");
				}

				$data = array();
				foreach($configs as $item){
						$dbconf = array();
					  $dbconf['charset'] = 'utf8';
						$dbconf['ip'] = $item->conn_ip;
						$dbconf['port'] = $item->conn_port;
						$dbconf['database'] = $item->conn_database;
						$dbconf['username'] = $item->conn_username;
						$dbconf['password'] = substr(base64_decode($item->conn_pwd), 4);

						$dblink = $this->getDbConnection($dbconf);

						//打标记注意加log
						if($dblink===false) continue;
	
						$sth = $dblink->prepare($item->sql);	
						$sth->execute($timeRange);
					  $count = $sth->fetchColumn();
		
						$type = $item->name."_".$cyc;
						$group = $item->id."@config_mondb";	
						
            $tmp = array();
            $tmp['tid'] = $this->getTypeID($type, $group);
            $tmp['count'] = $count;
            $tmp['ctime'] = strtotime($timeRange[":end_time"]) - 86400;
            $data[] = $tmp;	
			 }
				
			 $this->insertData($data, "count_data");
		}

		
    public function actionCountTypeUsers($base=0){
        //时间对比只支持年月日时分秒格式
        $timeRange = $this->getTimeRange("daily", $base);

        //获取监控状态为1，且$cyc为1的监控项
        $condition = " `stat`=1 and `daily`=1 ";
        $configs =  ConfigMondb::model()->findAll( $condition );
        if( empty($configs) ){
            exit("No Configs!\n");
        }
			
				//获取详情sql
				$array = $this->getUserDetails();   

        $data = array();
				foreach($configs as $item){
						$dbconf = array();
            $dbconf['charset'] = 'utf8';
            $dbconf['ip'] = $item->conn_ip;
            $dbconf['port'] = $item->conn_port;
            $dbconf['database'] = $item->conn_database;
            $dbconf['username'] = $item->conn_username;
            $dbconf['password'] = substr(base64_decode($item->conn_pwd), 4);

						$sql = isset($array[$item->name])?$array[$item->name]:null;
            $dblink = $this->getDbConnection($dbconf);

            //打标记注意加log
            if($dblink===false || $sql==null) continue;

            $sth = $dblink->prepare($sql);
            $sth->execute($timeRange);
            $reader = $sth->fetchAll(PDO::FETCH_ASSOC);
					
						$data = array();          
						$tid = CommonCountData::getTid($item->name."_daily");                                                                                                      			        foreach($reader as $row){                                                                                                                 
                $username = $row['username'];                                                                                                         

                $crit = array();                                                                                                                      
                $crit["condition"] = " `tid`=:tid and `username`=:username ";                                                                         
                $crit["params"] = array(":tid" => $tid, ":username" => $username);                                                                    
                $exists = CountTypeUsers::model()->exists($crit);                                                                                     
                if(!$exists){                                                                                                                         
                    $tmp = array();                                                                                                                   
                    $tmp["tid"] = $tid;
                    $tmp["username"] = $username;                                                                                                     
                    $tmp["create_time"] = strtotime($timeRange[":end_time"]) - 86400;                                                                                               
                    $data[] = $tmp;                                                                                                                   
                }                                                                                                                                     
            } 
						$this->insertData($data, "count_type_users"); 
				}

    }                                                                                                                                                 
                                                                                                                                                      
    private function getUserDetails(){                                                                                                                
        $array  = array();                                                                                                                            
        $array['dataware_total_order_number'] = "select distinct `owner` as `username` from `order` where :start_time=:start_time and `create_time`<:end_time";                 $array['dataware_PIE_order_number'] = "select distinct `owner` as `username` from `order` where :start_time=:start_time and `create_time`<:end_time and `order_type`='pie'";
				$array['dataware_ENTITY_order_number'] =  "select distinct `owner` as `username` from `order` where :start_time=:start_time and `create_time`<:end_time and `order_type`='entity'";                
				$array['dataware_OHTER_order_number'] = "select distinct `owner` as `username` from `order` where :start_time=:start_time and `create_time`<:end_time and `order_type`='other'"; 
				$array['dataware_total_orderUser_number'] = "select distinct `owner` as `username` from `order` where :start_time=:start_time and `create_time`<:end_time";
        $array['dataware_PIE_orderUser_number'] = "select distinct `owner` as `username` from `order` where :start_time=:start_time and `create_time`<:end_time and `order_type`='pie'";
        $array['dataware_ENTITY_orderUser_number'] =  "select distinct `owner` as `username` from `order` where :start_time=:start_time and `create_time`<:end_time and `order_type`='entity'";
        $array['dataware_OTHER_orderUser_number'] = "select distinct `owner` as `username` from `order` where :start_time=:start_time and `create_time`<:end_time and `order_type`='other'";  
				$array['dataware_total_dataOwner_number'] = "select distinct `create_by` as `username` from `data` where :start_time=:start_time and `create_time`<:end_time";
				$array['dataware_ENTITY_dataowner_count'] = "SELECT distinct c.`create_by` as `username` FROM `tag` a,`tag_resource_relation` b, `feature` c WHERE a.tag_name='实体数据' AND b.tag_id=a.id AND b.resource_tag='feature' AND c.id=b.resource_id AND :start_time=:start_time and c.`create_time`<:end_time;";        
        $array['dataware_PIE_dataowner_count'] = "SELECT distinct `create_by` as `username` FROM `data` WHERE data_name LIKE '%(pie-%' AND :start_time=:start_time and `create_time`<:end_time;";
                                                                                                                                              
        return $array;                                                                                                                                
    } 

		private function getTypeID($type, $group){
					$crit = array();
					$crit["condition"] = " `type`=:type and `group`=:group ";
					$crit["params"] = array(":type" => $type, ":group" => $group);

				  $tObj = CountType::model()->find($crit);
          if(!$tObj){
               $tObj = new CountType;
               $tObj->type = $type;
							 $tObj->group = $group;
               $tObj->create_time = time();
               $tObj->save();
          }	

					return $tObj->id;
		}


		private function getDbConnection($config = array()){
				$db = false;

				if(empty($config)) return $db;
				
				$con = array();
        $con[PDO::ATTR_ERRMODE] = true; 
        $con[PDO::ERRMODE_EXCEPTION] = true; 
        $con[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES {$config['charset']}";
        try{    
						$connectionString = "mysql:host={$config['ip']};port={$config['port']};dbname={$config['database']};";
        		$db = new PDO($connectionString, $config['username'], $config['password'], $con);  
        }catch(PDOException $e){
      			echo "Connection failed:{$e->getMessage()}";
    		}

				return $db;
		}

		private function getTimeRange($cycle, $base=0){
				$range = array();
				$time = time() - $base*86400;
				
				$range[':end_time'] = date("Y-m-d 00:00:00", $time);
				$end = strtotime($range[':end_time']);
				
				switch ($cycle){
						case "daily":
								$day = 1;
								break;
						case "weekly":
								$day = 7;
							  break;
						case "monthly":
								$day = 30;
								break;
				}		
			
				$range[':start_time'] = date("Y-m-d 00:00:00", $end - $day*86400);
				return $range;
		}

}
