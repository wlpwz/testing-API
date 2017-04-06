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
function smarty_function_theme($params, &$smarty){
	$baseUrl=Yii::app()->theme->baseUrl;
	return $baseUrl;
}
