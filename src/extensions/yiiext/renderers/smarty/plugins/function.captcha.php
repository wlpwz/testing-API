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
function smarty_function_captcha($params, &$smarty){
    //$captcha_code = vcode_gen('ms');        
    //$_SESSION['captcha_code'] = $captcha_code;      
    //return Yii::app()->request->baseUrl."/cgi-bin/genimg?{$captcha_code}";
    return Yii::app()->captcha->get();
}
