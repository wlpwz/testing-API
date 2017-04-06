<?php
class TConsoleCommand extends CConsoleCommand {
	protected function sendMail($content, $subject, $recievers){
		$content = iconv('utf-8', 'GBK', $content);
		$subject= iconv('utf-8', 'GBK', $subject);
		$headers  = 'MIME-Version: 1.0' . "\r\n";
  		$headers .= 'Content-type: text/html; charset=gbk' . "\r\n";
		$headers .= 'Cc: lichao11@baidu.com,zhangjing_qa@baidu.com' . "\r\n";
		$receivers = implode(',', $recievers);
  		//使用工具sendMail发送邮件
 		$ret = mail($receivers, $subject, $content, $headers);
		return $ret;
	
	}
}
?>
