<?php

class AuthController extends Controller
{
	public $layout=false;
	
	public function actionIndex()
	{
		if(Yii::app()->user->isGuest)
			Yii::app()->user->forceLogin(); 
		$this->render('index');
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
	}
    
	public function actionFakeerror($code){
		if($code)
			throw new CHttpException($code, '');
		else
		strpos('', '');
	}
}
