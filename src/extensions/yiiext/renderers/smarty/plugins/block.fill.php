<?php
/**
 * Allows to translate strings using Yii::t().
 *
 * Syntax:
 * {widget p='name'}
 * {widget p=['name',['a'=>'xx']]}
 *
 * @see CBaseController#beginWidget
 *
 * @param array $params
 * @param Smarty $smarty
 * @return string
 */
function smarty_block_fill($params, $content, $smarty, &$repeat){
	if (!empty($params['name']) &&!$repeat){
		$name='smarty_block_dig_'.$params['name'];
		$t=$smarty->getTemplateVars('this');
		$fill=(array)$t->getPageState($name);
		if(empty($params['key']))
			$fill[]=$content;
		else
			$fill[$params['key']]=$content;
		$t->setPageState($name, $fill);
	}
}