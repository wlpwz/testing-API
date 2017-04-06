<?php

class CronSendMailCommand extends CConsoleCommand
{
	public function actionRun()
	{
		$time_Year = strtotime(date("Y-01-01"));
		$time_Month = strtotime(date("Y-m-01"));
		
		#年的时间戳的差值，只要在此差值内，就表示在一年
		$year = strtotime(date("Y-01-01",strtotime("next year"))) - strtotime(date("Y-01-01"));

		#月的时间戳的差值，只要再此差值内，就表示在一个月
		$month = strtotime(date("Y-m-01",strtotime("next month"))) - strtotime(date("Y-m-01"));
		
		$cron = new Cron;

		$date = Cron::model()->findAll("is_del=:is_del",array('is_del'=>'0'));

		$DBdate = array();
		foreach($date as $d)	
		{
			$DBdate[$d->id]=array("topic"=>$d->topic_id,"state"=>$d->state,"act_time"=>"$d->act_lift_time");
		}
		
		
		$counter = array();
		
		for( $i=1 ; $i < 6; $i++)
		{
			$counter[$i]=array("state1"=>0,"state2"=>0,"state5"=>0,"month"=>0,"year"=>0);
		}
	
		
		foreach($DBdate as $var)
		{
			$counter[$var['topic']]['state'.$var['state']]+=1;
			if($var['act_time'] >= $time_Month and $var['act_time'] < $time_Month + $month)
			{
				$counter[$var['topic']]['month']+=1;
			}
			if($var['act_time'] >= $time_Year and $var['act_time'] < $time_Year + $year)
			{
				$counter[$var['topic']]['year']+=1;
			}
			
		}
		
		$head = "<p>WD项目测试周报</p>";
		$body = "<table style=\"border:solid 2px black;text-align:center;\">
		<tr>
		<td style=\"border:solid 2px black;\">方向</td>
		<td style=\"border:solid 2px black;\">提测项目</td>
		<td style=\"border:solid 2px black;\">测试中项目</td>
		<td style=\"border:solid 2px black;\">测试完成项目</td>
		<td style=\"border:solid 2px black;\">本年总数</td>
		<td style=\"border:solid 2px black;\">本月总数</td>
		</tr>
		<tr>
		<td style=\"border:solid 2px black;\">知识库</td>
		<td style=\"border:solid 2px black;\">".$counter[1]['state1']."</td>
		<td style=\"border:solid 2px black;\">".$counter[1]['state2']."</td>
		<td style=\"border:solid 2px black;\">".$counter[1]['state5']."</td>
		<td style=\"border:solid 2px black;\">".$counter[1]['year']."</td>
		<td style=\"border:solid 2px black;\">".$counter[1]['month']."</td>
		</tr>
		<tr>
		<td style=\"border:solid 2px black;\">服务平台</td>
		<td style=\"border:solid 2px black;\">".$counter[2]['state1']."</td>
		<td style=\"border:solid 2px black;\">".$counter[2]['state2']."</td>
		<td style=\"border:solid 2px black;\">".$counter[2]['state5']."</td>
		<td style=\"border:solid 2px black;\">".$counter[2]['year']."</td>
		<td style=\"border:solid 2px black;\">".$counter[2]['month']."</td>
		</tr>
		<tr>
		<td style=\"border:solid 2px black;test-align:center;\">数据价值</td>
		<td style=\"border:solid 2px black;\">".$counter[3]['state1']."</td>
		<td style=\"border:solid 2px black;\">".$counter[3]['state2']."</td>
		<td style=\"border:solid 2px black;\">".$counter[3]['state5']."</td>
		<td style=\"border:solid 2px black;\">".$counter[3]['year']."</td>
		<td style=\"border:solid 2px black;\">".$counter[3]['month']."</td>
		</tr>
		<tr>
		<td style=\"border:solid 2px black;\">页面解析</td>
		<td style=\"border:solid 2px black;\">".$counter[5]['state1']."</td>
		<td style=\"border:solid 2px black;\">".$counter[5]['state2']."</td>
		<td style=\"border:solid 2px black;\">".$counter[5]['state5']."</td>
		<td style=\"border:solid 2px black;\">".$counter[5]['year']."</td>
		<td style=\"border:solid 2px black;\">".$counter[5]['month']."</td>
		</tr>
		<tr>
		<td style=\"border:solid 2px black;\">站长平台</td>
		<td style=\"border:solid 2px black;\">".$counter[4]['state1']."</td>
		<td style=\"border:solid 2px black;\">".$counter[4]['state2']."</td>
		<td style=\"border:solid 2px black;\">".$counter[4]['state5']."</td>
		<td style=\"border:solid 2px black;\">".$counter[4]['year']."</td>
		<td style=\"border:solid 2px black;\">".$counter[4]['month']."</td>
		</tr>
		</table>
		<p>详细信息请登录WD项目管理平台：http://cp01-testing-ps7101.cp01.baidu.com:8001/</p>
		<p>WDQA | 联系人: 刘宝国（hi:dabaohi）</p>";

		
		
		$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
		$mailer->IsMail();
		$mailer->IsHTML(true);
		$mailer->CharSet = 'UTF-8';
		$mailer->AddAddress("wangsiyuan02@baidu.com");
		#$mailer->AddAddress("liubaoguo@baidu.com");
		$mailer->From = 'wdqa@baidu.com';
		$mailer->FromName = 'WDQA';
		$mailer->Subject = 'WD项目管理平台';
		
		$mailer->Body =$head.$body;
		
		$mailer->Send();	
	}
}

