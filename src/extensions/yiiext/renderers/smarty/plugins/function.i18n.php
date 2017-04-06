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
function smarty_function_i18n($params, &$smarty){
	static $baseUrl=false;
	if($baseUrl===false){
		$baseUrl=Yii::app()->request->baseUrl;
		if(strlen($baseUrl)>0 &&strpos($baseUrl, '/')!==0)
			$baseUrl='/'.$baseUrl;
		$baseUrl.='/i18n/'.Yii::app()->language;
	}
	return $baseUrl;
}
