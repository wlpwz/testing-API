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
function smarty_block_widget($params, $content, $smarty, &$repeat){
	
	if (!empty($params['name']) &&!$repeat){
		$name=$params['name'];
		$t=$smarty->getTemplateVars('this');
		if(Yii::getPathOfAlias($name)==false)
			$name="application.components.widget.{$name}";
		$widgetParams=($count=count($smarty->smarty->_tag_stack)) ? $smarty->smarty->_tag_stack[$count-1]['p']:array();
		if(@is_array($params['params']))
			$widgetParams=array_merge($params['params'], $widgetParams);
		if(count($widgetParams))
			$t->beginWidget($name, $widgetParams);
		else
			$t->beginWidget($name);
		$t->endWidget();
		echo $content;
	}else{
		if(($count=count($smarty->smarty->_tag_stack))){
			$smarty->smarty->_tag_stack[$count-1]['p']=array();
		}
	}
}
