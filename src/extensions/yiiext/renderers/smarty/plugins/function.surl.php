<?php
/**
 * generate url with site param get from SController
 *
 * Syntax:
 * {surl url="/absolute/url"}
 * {surl url="controller/action?param=value"}
 * {surl url=["controller/action"]}
 *
 * @see CHtml::normalizeUrl().
 *
 * @param array $params
 * @param Smarty $smarty
 * @return string
 */
function smarty_function_surl($params, &$smarty){
	if(!empty($params['url'])){
        $return=surl(@$params['url'], @$params['pass']);
		if(@$params['var']){
			$smarty->assign($params['var'], $return);
			return;
		}else
			return $return;
	}
    return null;
}
