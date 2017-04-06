<?php
	class CombinedController extends Controller{
		public $layout = "main";
   		public function filters(){
        	return Array('login');
		}
		 public function actionIndex($topic='', $state = '', $keyword = ''){
			$r=array();

			$this->renderPartial('index', $r);
		}
}

?>
