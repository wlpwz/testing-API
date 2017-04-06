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
function smarty_modifier_strim($string, $width, $trimmarker='…')
{
    $string=(string)$string;
    $ret=mb_strimwidth($string, 0, $width, $trimmarker);
    if($ret===$string)
        return $ret;
    else
        return "<span title=\"".htmlspecialchars($string)."\">{$ret}</span>";
}
