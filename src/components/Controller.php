<?php
class Controller extends CController{
    const AUTO='auto';  
    const HTML='html';  
    const JSON='json';
    public $layout='index';
	public $needLogin = true;

   /* public function filters()
    {
        return ['popLog'];
    }*/
	public function filterLogin( $filterChain ) {
		 if($this->needLogin){
     		Yii::app()->user->login();
              //  phpCAS::forceAuthentication();
         }
     	 $filterChain->run();
	}
		public function filters()
        {       
            return array('popLog');
        }       
        public function filterPopLog(CFilterChain $chain){
        $username = Yii::app()->user->name; //获取登录用户，注意结合项目实际获取方式更改
        $url = $chain->controller->id."/".$chain->action->id;
        POP::log("page", $url, $username);
        $chain->run();
        }     
/*    public function filterPopLog(CFilterChain $chain){
        $chain->run();
    }*/

	public function isAjaxRequest(){
        return Yii::app()->request->isAjaxRequest;  
    }
    public function getIsPost(){
        return Yii::app()->request->isPostRequest;
    }
    public function r($data=null, $view=null, $return=false, $renderType=self::AUTO){

        if(($renderType==self::AUTO && $this->isAjaxRequest()) || $renderType==self::JSON){
            if($return)
                return CJSON::encode(ActiveRecord::artoarray($data));
            else{
                echo CJSON::encode(ActiveRecord::artoarray($data));
                Yii::app()->end();
            }
        }else{
            if(is_null($view)&& !is_null($this->action) && !is_null($this->action->id)){
                $view=strtolower($this->action->id);
            }
            if($return)
                return $this->render($view, $data, $return);
             else{
                $this->render($view, $data, $return);
                Yii::app()->end();
             }
        }
    }
    public function json($status, $data=null){
        if(is_array($status))
            $this->r($status, null, false, self::JSON);
        else{
            if(is_object($status)){
                $this->r($status);
            }
            if(!is_array($data))
                $data=(array)$data;
            $data['status']=intval($status);
            $this->r($data, null, false, self::JSON);
        }
    }

    /**
     * @param string $command
     * @param array $data
     * @return bool
     */
    public function checkActsctrl($command='common',$data=null)
    {
        $ac = Yii::app()->actsctrl;
        $result = $ac->check($command,$data);
        if ($result === false || $result['code']==0 ) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * only for log
     */
  /*  protected function beforeAction($action)
    {
        Sitemap\Log::setInfo($action->controller->id.'/'.$action->id, user()->id, $_GET['site'], '');
        Sitemap\Monitor\Navigation::log();
        return true;
    }*/
}
