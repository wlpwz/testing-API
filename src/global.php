<?php

function endswith($string, $end, $sensitive=true){
	return $sensitive? (strpos(strrev($string), strrev($end))===0):(stripos(strrev($string), strrev($end))===0);
}

function hourformat($num) {
	$minus = "";
	if($num < 0) {
		$minus = "-";
		$num = abs($num);
	}
	$hour = floor($num/3600);
	$minute = floor(($num-$hour*3600)/60);
	$second = floor($num%60);
	return sprintf($minus."%02d:%02d:%02d", $hour, $minute, $second);
}

/* return the date of timestamp, and the count value */
function datecount($item) {
	//item format: [1364054400 * 1000, 1623]
	$sec = (int)explode("[", $item)[1];
	$datefmt = date('Y-m-d', $sec);
	$count = (int)trim(explode(",", $item)[1]);
	return array("date"=>$datefmt, "count"=>$count);
}

/* return the hour of timestamp, and the count value */
function hourcount($item) {
  //item format: [1364054400 * 1000, 1623]
  $sec = (int)explode("[", $item)[1];
  $hourfmt = date('Y-m-d H:00', $sec);
  $count = (int)trim(explode(",", $item)[1]);
  return array("hour"=>$hourfmt, "count"=>$count);
}

/*Send mail*/
function SendMail($topic,$project,$flag)
{
	#优先级的调整
	$priorityList = array("1"=>"最高", "3"=>"普通");
	$priority_mail = $priorityList[$project->priority];
	#项目分级的调整
	$levelList = array("1"=>"A级", "2"=>"B级", "3"=>"C级", "4"=>"D级");
	$level_mail = $levelList[$project->level];

	$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
	$mailer->IsMail();
	$mailer->IsHTML(true);
	$mailer->CharSet = 'UTF-8';
	#针对管理和编辑、新建的区别项的调整
	if($flag == 1 || $flag == 0)
	{
		$act_lift_time = "-";
		$report_time = "-";
		$qa_master = "-";
		$qa_reviewer = "-";
	}
	else if($flag == 2 || $flag == 3)
	{
		if($project->act_lift_time != "")
		{
			$act_lift_time = date('Y/m/d H:i:s',$project->act_lift_time);
		}
		else
		{
			$act_lift_time = "-";
		}
		if($project->report_time != "")
		{
			$report_time = date('Y/m/d H:i:s',$project->report_time);
		}
		else
		{
			$report_time = "-";
		}
		$qa_master = $project->qa_master;
		$qa_reviewer = $project->qa_reviewer;
	}
	else
	{
		echo "unknown flag!";
	}


	####################EMAIL的信息格式化#########################
	if( $flag == 1 ) #新建
	{	
		$message = '<p>【'.$project->rd.'】同学提测了项目【'.$project->icafe.'】，请尽快安排QA负责人</p>';
	}
	else if($flag == 0) #编辑
	{
		$message = '<p>【'.$project->rd.'】同学编辑了项目【'.$project->icafe.'】</p>';
	}
	else if($flag == 2)
	{
		$message = '<p>项目【'.$project->icafe.'】详情有更新，请知晓</p>';
	}
	else if($flag == 3)
	{
		$message = '<p>项目【'.$project->icafe.'】已被【'.Yii::app()->user->name.'】删除，请知晓</p>';
	}
	$body = "<table style=\"border:solid 2px #fedcbd;text-align:center; margin:0 auto;\">
	<tr>
	<th style=\"border:solid 2px #fedcbd;text-align:center;width:20%;\" >项目信息：</th>
	<th style=\"border:solid 2px #fedcbd;text-align:left;\">具体内容</th>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">优先级</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$priority_mail</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">项目分级</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$level_mail</td>
	</tr>
	<tr>
		<td  style=\"border:solid 2px #fedcbd;text-align:center;\">icafe项目</td>
		<td  style=\"border:solid 2px #fedcbd;text-align:left;\">$project->icafe</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">模块</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$project->module</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">版本</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$project->version</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">代码规模</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$project->codelines</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">RD负责人</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$project->rd</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">QA负责人</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$qa_master</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">QA评审人</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$qa_reviewer</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">预期提测时间</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$project->lift_date</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">实际提测时间</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$act_lift_time</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">测试完成时间</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$report_time</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">预期上线时间</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$project->online_date</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">升级内容</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$project->content</td>
	</tr>
	<tr>
		<td style=\"border:solid 2px #fedcbd;text-align:center;\">预期上线影响</td>
		<td style=\"border:solid 2px #fedcbd;text-align:left;\">$project->influence</td>
	</tr>
	</table><br>
	详细信息请登录WD项目管理平台：http://cp01-testing-ps7101.cp01.baidu.com:8001/<br>
	WDQA | 联系人: 刘宝国（hi:dabaohi）";
	######################################################################
    $mailer->AddAddress("liubaoguo@baidu.com");
	if($flag != 3)
	{
		$mail_name = explode(",",$project->rd);
		foreach($mail_name as $name)
		{
			$mailer->AddAddress("$name@baidu.com");
		}
		if($flag == 2)
		{
			$mail_name_qa_reviewer = explode(",",$project->qa_reviewer);
			$mail_name_qa_master = explode(",",$project->qa_master);
			foreach($mail_name_qa_reviewer as $name)
			{
				$mailer->AddAddress("$name@baidu.com");
			}
			foreach($mail_name_qa_master as $name)
			{
				$mailer->AddAddress("$name@baidu.com");
			}
	
		}
	}
	$mailer->From = 'wdqa@baidu.com';
	$mailer->FromName = 'WDQA';
	$mailer->Subject = 'WD项目管理平台_【'.$project->icafe.'】';
	$mailer->Body = $message.$body;
	return  $mailer->Send();
}
/*end*/

class Conf{
	static $array;
	static function load($path){
		self::$array=array();
		foreach((array)scandir($path) as $file){
			if(endswith($file, '.yml', false)){
				$array=yaml_parse_file($path.'/'.$file);
				if(is_array($array))
					self::$array=array_merge_recursive(self::$array, $array);
			}
		}
	}
	static function hasKey(){
		$keys=func_get_args();
		$cursor=& self::$array;
		foreach($keys as $key){
			if(isset($cursor[$key]))
				$cursor=&$cursor[$key];
			else
				return false;
		}
		return true;

	}
	static function getKey(){
		list($value, $exists)=self::realGetKey(func_get_args());
		return $value;
	}
	static function requireKey(){
		$keys=func_get_args();
		list($value, $exists)=self::realGetKey($keys);
		if($exists)
			return $value;
		throw new Exception('config error:'.implode(',', $keys));
	}
	static function realGetKey($keys){
		$cursor=& self::$array;
		foreach($keys as $key){
			$key=(string)$key;
			if(is_array($cursor) && isset($cursor[$key]))
				$cursor=&$cursor[$key];
			else
				return array(null, false);
		}
		return array($cursor, true);
	}
	static function getKeyDefault(){
		$keys=func_get_args();
		$default=array_pop($keys);
		list($value, $exists)=self::realGetKey($keys);
		return $exists? $value: $default;
	}
}
if(defined('CONFIG'))
	Conf::load(CONFIG);
