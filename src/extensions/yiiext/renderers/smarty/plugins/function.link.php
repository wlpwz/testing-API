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
function smarty_function_link($params, &$smarty){
	if(!empty($params['text']) &&!empty($params['url'])){
		$url=$params['url'];
		$options= empty($params['options'])||!is_array($params['options'])? array():$params['options'];
		if(!empty($params['active'])){
			$action=is_array($url)? reset($url):$url;
			if($action==$smarty->getTemplateVars('this')->getRoute()){
				$classKey='class';
				if(count($options)>0){
					foreach(array_keys($options) as $key){
						if(strtolower(trim($key))=='class'){
							$classKey=$key;
							break;
						}
					}
				}
				$options[$classKey] = isset($options[$classKey])? $options[$classKey].' '.$params['active']:$params['active'];
			}
		}
		if(!empty($params['pass']) &&is_array($url)){
			$pass=is_array($params['pass']) ? $params['pass']:$_GET;
			$first=array_shift($url);
			$url=array_merge($pass, $url);
			array_unshift($url, $first);
		}
		return CHtml::link($params['text'], $url, $options);
	}
}