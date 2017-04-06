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
function smarty_function_pager($params, &$smarty){
	if(is_array(@$params['url'])&&!empty($params['page'])&&!empty($params['pagesize']) && $params['pagesize']>0 &&isset($params['count'])){
		$url=$params['url'];
		$page=intval($params['page']);
		$count=intval($params['count']);
		$totalPage=ceil($count/$params['pagesize']);
		if($totalPage>1){
			if(!empty($params['pass']) &&is_array($url)){
				$pass=is_array($params['pass']) ? $params['pass']:$_GET;
				$first=array_shift($url);
				$url=array_merge($pass, $url);
				array_unshift($url, $first);
				//$url['pagesize']=$params['pagesize'];
			}
			if(!empty($params['skip']) && is_array($url)){
				$skip=(array)$params['skip'];
				foreach($skip as $item){
					unset($url[$item]);
				}
			}
			$out='';
			if($page!=1){
				$url['page']=1;
				$out.=CHtml::link(t('app', '首页'), $url).'&nbsp;';
				$url['page']=$page-1;
				$out.=CHtml::link(t('app', '上一页'), $url).'&nbsp;';
			}
			$max=isset($params['max'])? intval($params['max']) :10;
			if($max<1) $max=10;
			$begin=1;$end=$totalPage+1;
			if($max<$totalPage){
				$left=intval(floor(($max-1)/2));
				$right=$max-$left-1;
				if($page>$left) $begin=$page-$left;
				$end=$begin+$max;
				if($end>$totalPage){
					$end=$totalPage+1;
					$begin=$end-$max;
				}
			}
			for($i=$begin;$i<$end;$i++){
				$url['page']=$i;
				$out.= $i==$page? "<strong>{$i}</strong>":CHtml::link($i, $url);
				$out.= '&nbsp;';
			}
			if($page!=$totalPage){
				$url['page']=$page+1;
				$out.=CHtml::link(t('app', '下一页'), $url).'&nbsp;';
				$url['page']=$totalPage;
				$out.=CHtml::link(t('app', '尾页'), $url);
			}
			return $out;
		}
	}
}
