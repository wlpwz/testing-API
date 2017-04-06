<?php
class SwiftMessage extends CController{
    private $mailer;
    private $realMessage;
    public $layout=false;
    public function __construct($mailer, $realMessage){
        $this->mailer=$mailer;
        $this->realMessage=$realMessage;
    }
    public function embed($path){
    }
    protected function realSend($to, $from, $encoding='utf-8', $useRelay=false){
        $this->realMessage->setFrom($from);
        if(is_string($to))
            $to=preg_split('/;/', $to, -1, PREG_SPLIT_NO_EMPTY);
        if($to){
            $this->realMessage->setTo($to);
            if($useRelay){
                $id=$this->realMessage->getId();
                $id=substr($id, 0, strpos($id, '@'));
                $this->realMessage->setId($id.'@baidu.com');
                return $this->mailer->relaySend($this->realMessage);
            }else{  
                return $this->mailer->localSend($this->realMessage);
            }       
        }
        return false;
    }
    public function send($to, $from, $encoding='utf-8'){
        return $this->realSend($to, $from, $encoding, true);
    }
    public function fatal($to=null){
        if($to=$to?$to:Conf::getKeyDefault('LOG', 'EMAIL', 'FATAL', false)){
            $this->realSend($to, 'sitemap-alert@'.php_uname('n'));
        }
    }
    public function warning($to=null){
        if($to=$to?$to:Conf::getKeyDefault('LOG', 'EMAIL', 'WARNING', false)){
            $this->realSend($to, 'sitemap-alert@'.php_uname('n'));
        }
    }
	public function getViewFile($viewName)
    {
        //$moduleViewPath=$basePath=Yii::app()->getViewPath();
        $moduleViewPath=$basePath=Yii::app()->getBasePath().DIRECTORY_SEPARATOR.'views';
        if(($module=$this->getModule())!==null)
        $moduleViewPath=$module->getViewPath();
        return $this->resolveViewFile($viewName,$moduleViewPath.DIRECTORY_SEPARATOR.'mail',$basePath,$moduleViewPath);
    }
    public function getViewPath()
    {
        if(($module=$this->getModule())===null)
            $module=Yii::app();
        $r=$module->getViewPath().DIRECTORY_SEPARATOR.'mail';
        return $r;
    }
	public function processOutput($output)
    {
        return $output;
    } 
    public function setSubject($value){
        $this->realMessage->setSubject($value);
    }
    public function getSubject(){
        return $this->realMessage->getSubject();
    }
    public function getBody(){
        return $this->realMessage->getBody();
    }
}
class SwiftMailer extends CApplicationComponent{
    public $viewPath = 'application.views.mail';
    public $type = 'php';
    public $options=false;
    private $_swift=false;
    private $_phpmailer=false;
    private $_relaymailer=false;
    static function loadSwift(){
        if(defined('SWIFT_INIT_LOADED'))
            return;
		Yii::import('application.vendors.*');
        require_once('Swift/classes/Swift.php');
        Yii::registerAutoloader(array('Swift','autoload'));
        require_once('Swift/swift_init.php');
    }
    protected function getPhpmailer(){
        if(!$this->_phpmailer){
            $t=Swift_MailTransport::newInstance();
            if($this->options!==null)
                $t->setExtraParams($this->options);

            $this->_phpmailer=Swift_Mailer::newInstance($t);
        }
        return $this->_phpmailer;
    }
    protected function getRelaymailer(){
        if(!$this->_relaymailer){
            $relayserver=Conf::requireKey('EMAIL', 'RELAY');
            $t=Swift_SmtpTransport::newInstance($relayserver);
            if($this->options){
                foreach($this->options as $k=>$v){
                    $t->{'set'.ucfirst($k)}($v);
                }
            }
            $this->_relaymailer=Swift_Mailer::newInstance($t);
        }
        return $this->_relaymailer;
    }
    public function localSend($msg){
        return $this->phpmailer->send($msg);
    }
    public function relaySend($msg){
        return $this->relaymailer->send($msg);
    }
    public function createMsg($view, $data=null, $subject=null){
        SwiftMailer::loadSwift();
        $realMessage=Swift_Message::newInstance();
        if(!is_null($subject))
            $realMessage->setSubject($subject);
        $msg=new SwiftMessage($this, $realMessage);
        $body=$msg->render($view, $data, true);
        $realMessage->setBody($body, 'text/html');
        return $msg;
    }
    public function createSimpleMsg($subject, $body){
        SwiftMailer::loadSwift();
        $realMessage=Swift_Message::newInstance();
        $realMessage->setSubject($subject);
        $realMessage->setBody($body, 'text/html');
        $msg=new SwiftMessage($this, $realMessage);
        return $msg;
    }
}
