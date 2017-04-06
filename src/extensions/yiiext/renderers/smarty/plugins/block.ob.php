<?php
/**
 * Allows to translate strings using Yii::t().
 *
 * Syntax:
 * {ob var='name'}
 *
 * @see CBaseController#beginWidget
 *
 * @param array $params
 * @param Smarty $smarty
 * @return void
 */
function smarty_block_ob($params, $content, $smarty, &$repeat){
	if (!empty($params['var']) &&!$repeat){
        $smarty->assign($params['var'], $content);
    }
}
