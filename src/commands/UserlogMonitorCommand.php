<?php
class UserlogMonitorCommand extends ConsoleCommand{
		private $time;
	  private $storePath;
	
		public function actionImportData($day){
			$this->time = time()-$day*86400;
			$this->storePath = DATA_PATH."/userlog/";
			$date = date("Ymd", $this->time);

			//Get Configure Monitor Stat=1		
			$crit = array();
			$crit["condition"] = " `stat`=:stat ";
			$crit["params"] = array(":stat" => 1);
			$configures = ConfigUserlog::model()->findAll($crit);

			if($configures){
					foreach($configures as $cval){
						  $data = array();
							$location = explode("\n", $cval->location);

							if(!$location) continue;		
							foreach($location as $lval){
								 $infile = $lval.".".$date;
								
							   $outfile = $this->dumpPromotLog($infile, $this->storePath); 	 		
								 $data = array_merge($data, $this->getDetails($outfile)); 
							}	

							//入库uv详情
              $uvDetails = $this->statUvDetails($data, $cval->id);

							//统计uv/pv概括信息
							$items = ConfigUserlogItems::model()->findAll(array("condition" => " `cid`=:cid ", "params" => array(":cid" => $cval->id)));							
							foreach($items as $ival){
									$result = array();
									$result = $this->analyzeUserlog($data, $ival);
									$result['cid'] = $ival->cid;
									$result['item_id'] = $ival->id;
									$result['ctime'] = strtotime(date("Y-m-d 00:00:00", $this->time));
								  $insData = array($result);	
									$this->insertData($insData, "userlog_summary");
							}
							$cval->last_crawl_time = time();
							$cval->save();
					}
			}
		}

		public function actionClusterDetails($cycle, $base=0){
		    if($cycle==7){
            $tablename = "userlog_summary_weekly";
        }elseif($cycle==30){
            $tablename = "userlog_summary_monthly";
        }else{  
            exit("Invalid Cycle!\n");
        }       
  
        $time = strtotime(date("Y-m-d")) - $base*86400;
        $start = $time - $cycle*86400;
				$this->time = $time-86400;
				
				//取数据进行计算
				$result = $crit = array();
				$crit["condition"] = " `ctime`>:start and `ctime`<=:end ";
				$crit["params"] = array(":start" => $start, ":end" => $time); 
				$details = UserlogDetails::model()->findAll($crit);
				
				if($details){
						//按照cid-》url格式化
					  $temp = $res = array();
						foreach($details as $dval){
								if(!isset($temp[$dval->cid])) 
										$temp[$dval->cid] = array();
								$temp[$dval->cid][$dval->url][]	= $dval;
						}	

						foreach($temp as $cid => $cval){
								$res[$cid] = array();
							  $items = ConfigUserlogItems::model()->findAll(array("condition" => " `cid`=:cid ", "params" => array(":cid" => $cid)));
								foreach($items as $ival){
									  $res[$cid][$ival->id] = array("pv" => 0, "all_uv" => array(), "new_uv" => array());
										$pattern = $ival->pattern;
									
										foreach($cval as $url => $cval0){
												foreach($cval0 as $ccval){
														if(preg_match('@'.$pattern.'@', $url)===0) continue;
														$count ++;
                        
														$res[$cid][$ival->id]["pv"] += $ccval->visit_count;
														$res[$cid][$ival->id]["all_uv"][] = $ccval->username;
												
														$isExist = UserlogUsersItems::model()->exists(array("condition" => " `cid`=:cid and `item_id`=:item_id and `username`=:username and `create_time`<=:start ",
																																		 "params" => array(":cid" => $cid, ":item_id" => $ival->id, ":username" => $ccval->username,":start" =>$start)
															));
														if(false === $isExist)
															 $res[$cid][$ival->id]["new_uv"][] = $ccval->username;
												}
										}
										

								}	
						}			
					
						foreach($res as $cid => $rval){
								foreach($rval as $item_id => $rval0){
										$tmp = array();
										$tmp['cid'] = $cid;
										$tmp['item_id'] = $item_id;
										$tmp['pv'] = ceil($rval0['pv']/$cycle);
										$tmp['new_uv'] = count(array_unique($rval0['new_uv']));
										$tmp['all_uv'] = count(array_unique($rval0['all_uv']));
										$tmp['ctime'] = $this->time;
										$result[]  = $tmp;
								}
						}
						
				}

				 $this->insertData($result, $tablename);
		}


		protected function statUvDetails($data, $cid){
			 if(!$data) return;

			 //分析数据
			 $users = $uv = array();
			 foreach($data as $dval){
				  $users[$dval['username']] = $dval['username'];
					if(!isset($uv[$dval['username']])) $uv[$dval['username']] = array(); 	
					if(!$uv[$dval['username']][$dval['url']]){
								$uv[$dval['username']][$dval['url']] = array();
								$uv[$dval['username']][$dval['url']]['visit_count'] = 0;
								$uv[$dval['username']][$dval['url']]['last_visit_time'] = 0;
					}
					$uv[$dval['username']][$dval['url']]['visit_count'] ++;
					if($dval['last_visit_time'] > $uv[$dval['username']][$dval['url']]['last_visit_time']){
							$uv[$dval['username']][$dval['url']]['last_visit_time'] = $dval['last_visit_time'];
					}
			 }

		    $userlog_details = array();
	
				//UV详情入库
				foreach($uv as $uname => $uval){
						foreach($uval as $url => $uval1){
								$tmp = array();
								$tmp['cid'] = $cid;
								$tmp['username'] = $uname;
								$tmp['url'] = $url;
								$tmp['visit_count'] = $uval1['visit_count'];
								$tmp['last_visit_time'] = $uval1['last_visit_time'];
								$tmp['ctime'] = strtotime(date("Y-m-d 00:00:00", $this->time));
								$userlog_details[] = $tmp;
						}
				}
				$this->insertData($userlog_details, "userlog_details");

				return $uv;
		}

		protected function analyzeUserlog($data, $item){
				$result = array("pv"=>0, "new_uv" =>0, "all_uv" => 0);			

				//初始化变量
				$pv = 0;
				$nuv = $auv = array();
				$pattern = $item->pattern;
				foreach($data as $dval){
						if(preg_match('@'.$pattern.'@', $dval["url"])===0) continue;
						$pv ++;
						$auv[$dval['username']] = $dval['username'];		
						if(!$this->isExsit($item->cid, $item->id, $dval['username'])) {
									$nuv[$dval['username']] = $dval['username'];
						}
				}
				$result['pv'] = $pv;
				$result['all_uv'] = count($auv);
				$result['new_uv'] = count($nuv);

				return $result;
		}

		private function isExsit($cid, $item_id, $username){
				$condition = " `item_id`=:item_id and `username`=:username ";
			  $params = array(":item_id" => $item_id, ":username" => $username);
				$isExsit = UserlogUsersItems::model()->exists($condition, $params);

				$this->updateUsers($username);	
				if(false === $isExsit){
						//入库新记录
						$obj = new UserlogUsersItems;
						$obj->cid = $cid;
						$obj->item_id = $item_id;
            $obj->username = $username;
						$obj->create_time = strtotime(date("Y-m-d 00:00:00", $this->time));
						$obj->save();
				}
				
				return $isExsit;
		}
	
		protected function updateUsers($username){
        $superior_name = Yii::app()->userInfo->getSuperiorByUsername($username);
        $userObj = Yii::app()->userInfo->getUserByUsername($username);
        if($userObj){
             $department = $userObj->departmentName;
             $position = $userObj->positionName?$userObj->positionName:$userObj->employeeType;
        }
				$product = Yii::app()->userInfo->getAllProductlinesByUsername($username);
        $create_time = strtotime(date("Y-m-d 00:00:00", $this->time));

				$oval = UserlogUsers::model()->find(array("condition"=>" `username`=:username ", "params" => array(":username" => $username)));
			
				if(!$oval){
						$oval = new UserlogUsers;
						$oval->username = $username;
						$oval->create_time = $create_time;
				}
				$oval->product = $product;
        $oval->position = $position;
        $oval->department = $department;
        $oval->superior_name = $superior_name;
        $oval->save();
		}

		protected function dumpPromotLog($infile, $outpath){                                                                               
				$fields = explode("/", $infile);

				$name = array_pop($fields);
				$output = $outpath.$fields[2]."_".$name;    
    		exec("wget -O {$output}  {$infile}&", $info);                                                                    
    		
				return $output;                                                                                                                      
  	}   

		protected function getDetails($output){
				$data = array();
				if(!file_exists($output)) return $data;
				
				$fp = @fopen($output, "r");
				if($fp){
						while(!feof($fp)){
								$line = fgets($fp);
								$line = rtrim($line); 
								if(empty($line)) continue;

								$columns = explode("\t", $line);
								$tmp = array();
								$tmp["username"] = $columns[0];
								$tmp["url"] = $columns[1];
								$tmp["last_visit_time"] = $columns[2];			
								$data[] = $tmp;
						}
				}				
				fclose($fp);

				return $data;
		}

}
