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
function smarty_block_dig($params, $content, $smarty, &$repeat){
	if (!empty($params['name']) &&!$repeat){
		$t=$smarty->getTemplateVars('this');
		$fill=$t->getPageState('smarty_block_dig_'.$params['name']);
		if(@$params['rtl']&&is_array($fill)){
			$fill=array_reverse($fill);
		}
		if(is_null($fill)){
			echo $content;
		}else{
            if(@$params['mode']=='compact')
                echo implode("", (array)$fill);
            else
                echo implode("\n", (array)$fill);
		}
	}
}
