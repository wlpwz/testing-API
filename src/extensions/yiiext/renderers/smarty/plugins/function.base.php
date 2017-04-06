<?php
/**
 * generate the site's url according to request.
 *
 * Syntax:
 * {base}
 *
 * @see Yii::app()->request
 *
 * @return string
 */
function smarty_function_base($params, &$smarty){
	static $baseUrl=false;
	if($baseUrl===false){
		$baseUrl=Yii::app()->request->baseUrl;
		if(strlen($baseUrl)>0 &&strpos($baseUrl, '/')!==0)
			$baseUrl='/'.$baseUrl;
	}
	return $baseUrl;
}
