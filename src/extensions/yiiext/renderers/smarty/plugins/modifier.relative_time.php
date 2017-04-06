<?php
/*
 * nifeng 2012/9/7
 * note:the number in function(number_format in php) is float.
 *      if the string is used, be attention to the length of the string.
 */
function smarty_modifier_relative_time($time)
{
    $diff = time() - $time;
    $type = [
        '年' => 31536000,
        '月' => 2592000,
        '天' => 86400,
        '小时' => 3600,
        '分种' => 60,
    ];
    foreach ($type as $key => $value){
        if (($num = $diff / $value) >= 1){
            return (int)$num . $key . '前';
        }
    }
    return "不到一分钟前";
}
