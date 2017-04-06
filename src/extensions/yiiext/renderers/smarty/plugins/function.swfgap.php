<?php
/**
 * generate the site's url according to request.
 *
 * Syntax:
 * {base}
 *
 * @see Yii::app()->request
 *
 * @return string
 */
function smarty_function_swfgap($params, &$smarty){
	if(isset($params['max']) && isset($params['min']) && isset($params['var'])){
		$min=$params['min'];
		$max=$params['max'];
		if($min>$max)
			list($min, $max)=array($max, $min);
        //如果最大值和最小值相等，会造成flash显示上的bug,故而将最小minIdx设为0
        if ( $min == $max) {
            $min= 0;
        }
        if ( $max >= 1e9 ) {
            $dataSuffix = "KKKKKKKKI,III";
            $tick = " / 亿";
            if ( $max>= 1e12 ) {
                $gap = 1e11;
            }
            else if ( $max>= 1e11 ) {
                $gap = 1e10;
            }
            else if ( $max>= 1e10 ) {
                $gap = 1e9;
            }
            else {
                $gap = 1e8;
            }
        }
        else if ( $max>= 1e5 ) {
            $dataSuffix = "KKKKI,III";
            $tick = " / 万";
            if ( $max>= 1e8 ) {
                $gap = 1e7;
            }
            else if ( $max>= 1e7 ) {
                $gap = 1e6;
            }
            else if ( $max>= 1e6 ) {
                $gap = 1e5;
            }
            else {
                $gap = 1e4;
            }
        }
        else {
            $dataSuffix = "I,III";
            $tick = "";
            if ( $max>= 10000 ) {
                $gap = 1000;
            }
            else if ( $max>= 1000 ) {
                $gap = 100;
            }
            else if ( $max>= 100 ) {
                $gap = 10;
            }
            else {
                $gap = 1;
            }
        }
        if ( $max% $gap != 0 ) {
            $digit = (int)($max/$gap);
            $max= ($digit+1)*$gap;
        }
        $digit = (int)($min/$gap);
        $min= $digit*$gap;
        $diff= $max- $min;
        if ( $diff<= 3*$gap && $gap != 1e8  && $gap != 1e4 && $gap != 1 ){
            $gap = $gap/10;
        }
        $gap= $diff/$gap;
        if ( $gap% 10 == 0 ) {
            $splitNum = 10;
        }
        else if ( $gap% 5 == 0 ) {
            $splitNum = 5;
        }
        else if( $gap% 4 == 0 ) {
            $splitNum = 4;
        }
        else if( $gap% 3 == 0 ) {
            $splitNum = 3;
        }
        else if( $gap% 2 == 0 ) {
            $splitNum = 2;
        }
        else {
            $splitNum = 1;
        }
        $var=array('min'=>$min,'max'=>$max,'splitNum'=>$splitNum,'dataSuffix'=>$dataSuffix,'tick'=>$tick); 
        $smarty->assign($params['var'], $var);
	}
}
