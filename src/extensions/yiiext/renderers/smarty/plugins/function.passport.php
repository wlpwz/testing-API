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
function smarty_function_passport($params, &$smarty){
    $passporturl=Yii::app()->passport->url;
    $tpl=Yii::app()->passport->tpl;
	if($passporturl){
		$action=trim(@$params['action']);
		if(!$action)
			$action='login';
        if ($action == 'center' || $action == 'passchange'){
            return $passporturl.$action;
        }
        if(isset($params['outonly'])){
            return $passporturl."?{$action}";
        }else{
            $ssl=Yii::app()->request->isSecureConnection;
            $site=$ssl?'https://':'http://';
            $site.=Yii::app()->request->serverName;
            if(($port=Yii::app()->request->getServerPort())!=80) //使用getServerPort函数兼容1.0版本，使用port属性仅适用于1.1版本
                $site.=":{$port}";
            $out=$site;
            $baseUrl=Yii::app()->request->baseUrl;
            if(strlen($baseUrl)>0)
                $out.='/'.$baseUrl;
            if(!empty($params['url'])){
                $url=$params['url'];
                
                if(is_array($url)){
                    if(!empty($params['pass'])){
                        $pass=is_array($params['pass']) ? $params['pass']:$_GET;
                        $first=array_shift($url);
                        $url=array_merge($pass, $url);
                        array_unshift($url, $first);
                    }
                    $out=$site.CHtml::normalizeUrl($url);
                }
            }
            $out=urlencode($out.'');
            if(in_array($action, array('login', 'accountbindphone', 'accountbindemail', 'reg')))
                $passporturl.='v2/';
            $passporturl.="?{$action}&u={$out}&tpl={$tpl}";
            if($action==='reg')
                $passporturl.='&regType=1';
            return $passporturl;
        }
	}
    	
}
