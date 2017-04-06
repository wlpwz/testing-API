<?php
/*
 * nifeng 2012/9/7
 * note:the number in function(number_format in php) is float.
 *      if the string is used, be attention to the length of the string.
 */
function smarty_modifier_number_format($number, $empty = 0, $type = null)
{
    if (empty($number) || $number === 0){
        return $empty;
    } elseif ($type === 'time') {
        $hour = (int) ($number / 3600);
        $min = (int) ($number % 3600 / 60);
        $sec = (int) ($number % 3600 % 60);
        return sprintf("%02d:%02d:%02d", $hour,$min,$sec);
    } elseif ($type === 'percent') {
        return round($number*100,2) . "%";
    } else {
        return number_format((int)($number));
    }

}
