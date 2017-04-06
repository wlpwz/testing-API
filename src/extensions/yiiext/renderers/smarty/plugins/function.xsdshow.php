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
function smarty_function_xsdshow($params, &$smarty){
    if(!empty($params['template']) && !empty($params['var'])){
        $template=$params['template'];
        $var=Template2HTML::getFields($template);
        $smarty->assign($params['var'], $var);
    }
}
