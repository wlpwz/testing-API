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
 * @author tangjingxin
 * @param string $ 
 * @param string $ 
 * @param string $ 
 * @return string 
 */
function smarty_modifier_sub_mask($str, $len)
{
    $strlen=strlen($str);
    $mask= '...';
    if($strlen > $len){
        $pre_str = substr($str,0,$len);
        $str = $pre_str . $mask;
    }

    return $str;
}