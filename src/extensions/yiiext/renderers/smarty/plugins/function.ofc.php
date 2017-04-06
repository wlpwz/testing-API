<?php

function smarty_function_ofc($params, &$smarty){
	static $id=0;
	$id++;
	if(!empty($params['url'])){
		$url=CHtml::normalizeUrl($params['url']);
		$width=empty($params['width']) ? '100%':$params['width'];
		$height=empty($params['height']) ? '250':$params['height'];
		$js=empty($params['js']) ? false:intval($params['js']);
		$ofc=Yii::app()->request->baseUrl.'/open-flash-chart.swf';
return <<<EOD
<div class="ofc-embed" id="ofc-embed-{$id}">
 <object width="{$width}" height="{$height}" type="application/x-shockwave-flash" data="{$ofc}" id="ofc-embed-{$id}-inner" style="visibility: visible;">
	<param name="flashvars" value="data-file={$url}"/>
	<param name="movie" value="{$ofc}"/>
 </object>
</div>
EOD;

	}
}