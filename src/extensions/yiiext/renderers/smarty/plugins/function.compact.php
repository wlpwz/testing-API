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
function smarty_function_compact($params, &$smarty){
    if (!empty($params['var'])){
        $var=$smarty->getTemplateVars();
        $smarty->assign($params['var'], &$var);
    }
}
