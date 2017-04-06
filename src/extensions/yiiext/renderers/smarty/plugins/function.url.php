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
function smarty_function_url($params, &$smarty){
	if(!empty($params['url'])){
		$url=$params['url'];
		if(!empty($params['pass']) &&is_array($url)){
			$pass=is_array($params['pass']) ? $params['pass']:$_GET;
			$first=array_shift($url);
			$url=array_merge($pass, $url);
			array_unshift($url, $first);
		}
		if(!empty($params['skip']) && is_array($url)){
			$skip=(array)$params['skip'];
			foreach($skip as $item){
				unset($url[$item]);
			}
		}
		if(is_string($url)){
			if(strpos($url, '/')!==0) $url='/'.$url;
            $url = Yii::app()->request->baseUrl.$url;
		} else {
            $url = CHtml::normalizeUrl($url);
        }
		if (isset($params['absolute']) && $params['absolute'] && $url{0} === '/'){
            $url = Yii::app()->getRequest()->getHostInfo() . $url;
        }
        return $url;
	}
}
