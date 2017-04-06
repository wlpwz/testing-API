<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage PluginsModifier
 */

/**
 * Smarty replace modifier plugin
 * 
 * Type:     modifier<br>
 * Name:     replace<br>
 * Purpose:  simple search/replace
 * 
 * @link http://smarty.php.net/manual/en/language.modifier.replace.php replace (Smarty online manual)
 * @author Monte Ohrt <monte at ohrt dot com> 
 * @author Uwe Tews 
 * @param string $ 
 * @param string $ 
 * @param string $ 
 * @return string 
 */
function smarty_modifier_mask($str, $type='email')
{
    if($type=='email'){
        $email=$str;
        $index = strpos($email, '@');
        if( $index === false || $index <= 2 ) {
            return $email;
        }
        $pre = substr($email, 0, 2);
        $mask = '*';
        for($i = 1; $i < ($index-2); $i++) {
            $mask = $mask . '*';
        }
        $suf = substr($email, $index);
        $email = $pre . $mask . $suf;
        return $email;
    }elseif($type=='phone'){
        $phone=$str;
        $len = strlen($phone);
        if( $len !== 11 ) {
            return $phone;
        }
        $pre   = substr($phone, 0, 4);
        $mask  = '****';
        $suf   = substr($phone, 7);

        $phone = $pre . $mask . $suf;
        return $phone;
    }
    return $str;
}
