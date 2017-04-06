<?php
/**
 * Allows to generate links using CHtml::link().
 *
 * Syntax:
 * {link text="test"}
 * {link text="test" url="controller/action?param=value"}
 * {link text="test" url="/absolute/url"}
 * {link text="test" url="http://host/absolute/url"}
 *
 * @see CHtml::link().
 *
 * @param array $params
 * @param Smarty $smarty
 * @return string
 */
function smarty_function_widgetp($params, &$smarty){
	if(!empty($params['name']) && isset($params['value'])){
		if($count=count($smarty->smarty->_tag_stack)){
			if(!is_array($smarty->smarty->_tag_stack[$count-1]['p']))
				$smarty->smarty->_tag_stack[$count-1]['p']=array();
			$smarty->smarty->_tag_stack[$count-1]['p'][$params['name']]=$params['value'];
		}
	}
}