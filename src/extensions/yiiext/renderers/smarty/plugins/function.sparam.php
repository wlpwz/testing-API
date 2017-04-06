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
function smarty_function_sparam($params, &$smarty){
        $site = $_GET['site'];
		$url=(array)$params['param'];
		if(!empty($params['pass'])){
			$pass=is_array($params['pass']) ? $params['pass']:$_GET;
			$url=array_merge($pass, $url);
		}
		if(!empty($params['exclude'])){
			foreach((array)$params['exclude'] as $v){
				unset($url[$v]);
			}
		}
		if ($site && !isset($url['site'])){
			$url['site'] = $site;
		}
		$out='';
		foreach($url as $k=>$v){
			$out.="<input type='hidden' name='{$k}' value='{$v}'/>";
		}
		return $out;
}
