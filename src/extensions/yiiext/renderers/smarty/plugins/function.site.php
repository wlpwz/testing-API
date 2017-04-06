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
function smarty_function_site($params, &$smarty){
	$ssl=Yii::app()->request->isSecureConnection;
	$url=$ssl?'https://':'http://';
	$url.=Yii::app()->request->serverName;
	if(($port=Yii::app()->request->getServerPort())!=80)
		$url.=':'.$port;
    
	$baseUrl=Yii::app()->request->baseUrl;
	if(strlen($baseUrl)>0)
		$url.='/'.$baseUrl;
	return $url;
}
