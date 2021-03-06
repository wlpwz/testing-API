<?php
Yii::import('system.web.auth.CWebUser');
class SWebUser extends CWebUser{
	public $activeUrl=null;
	public $allowAutoLogin=false;
	private $isAuthenticated=false;
	public $sso;
	public $filterSuffix;
	public $handleLogout;
	public $redirecturl;
	public function init()
	{
		if(strstr($_SERVER['REQUEST_URI'], $this->filterSuffix)) return;
		if (!$this->redirecturl){
			$this->redirecturl =	Yii::app()->request->getHostInfo();
		}
		
		$string=Yii::getPathOfAlias('application.extensions.CAS.CAS');
		require_once($string.'.php');
		Yii::registerAutoloader('CAS_autoload');

		Yii::app()->getSession()->open();
      
        phpCAS::setDebug();
        phpCAS::client(CAS_VERSION_2_0,$this->sso[0],$this->sso[1],'');
        phpCAS::handleLogoutRequests(false);
        //phpCAS::handleLogoutRequests(true, $this->handleLogout);
        phpCAS::setNoCasServerValidation();
        phpCAS::forceAuthentication();
        $this->isAuthenticated=phpCAS::isAuthenticated();
        if($this->isAuthenticated){
            $username=phpCAS::getUser();
            if($this->id != $username)
            $this->restoreFromCookie();
        }
        if($this->getIsGuest()  && $this->allowAutoLogin)
            $this->restoreFromCookie();
        else if($this->autoRenewCookie && $this->allowAutoLogin)
            $this->renewCookie();
        if($this->autoUpdateFlash)
            $this->updateFlash();
        $this->updateAuthStatus();
      
	} 
	public function getIsGuest(){
		return !$this->isAuthenticated;
	}
	public function setEmail( $email ){
    	$this->setState( '__email' , $email );
    }
	public function login( $identity = null , $duration = 0 ){

		phpCAS::proxy();
		phpCAS::client(CAS_VERSION_2_0,$this->sso[0],$this->sso[1],'');
     	$this->isAuthenticated=phpCAS::isAuthenticated();
     	if($this->isAuthenticated){
     		$username=phpCAS::getUser();
     		$this->setEmail( $username.'@baidu.com');
     		if( empty( $this->username ) ){
     			$this->restoreFromCookie();

     		}
     	}else{
     		$this->forceLogin();
     	}

    }
	protected function restoreFromCookie(){ //autologin
		$username=phpCAS::getUser();
		$states=array();
		if($this->beforeLogin($username,$states,true))
		{
			$this->changeIdentity($username,$username,$states);
			$this->afterLogin(true);
		}
	}
	/*
		by Joe: 重写此部分避免重新生成session，因为该session_id被uuap记住，不能重写
	*/
	
	protected function changeIdentity($id,$name,$states){
		$this->setId($id);			
		$this->setName($name);			
		$this->loadIdentityStates($states);
	}
	public function forceLogin(){
		phpCAS::forceAuthentication();
	}
	public function logout(){
		//phpCAS::logout();
		phpCAS::logoutWithRedirectService($this->redirecturl);
	}
	private $_authAssignments=null;
	public function getAuthAssignments(){
		if(!$this->_authAssignments){
			$all=Yii::app()->getAuthManager()->getAuthItems(null, $this->id);
			$ret=array();
			if($all){
				$this->_getAuthAssignments($all, $ret);
			}
			$this->_authAssignments=$ret;
		}
		return $this->_authAssignments;
	}
	protected function _getAuthAssignments($arr, &$ret){
		foreach($arr as $item){
			$ret[$item->name]=$item;
		}
		foreach($arr as $item){
			if($all=$item->children){
				$this->_getAuthAssignments($all, $ret);
			}
		}
	}
}
