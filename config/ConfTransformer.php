<?php
/**
 * 将/home/work/sitemap-web/conf中的配置读出用define定义 
 * 分成public.conf和private.conf两个文件
 * private.conf用来设置密码等线上rd不可见的配置
 * public.conf用来所有其他配置
 *
 * @author zhaojianbo<zhaojianbo@baidu.com>
 */

define('CONF_PATH', dirname(dirname(__FILE__))."/config/");

define('MAX_LENGTH', 1024);
$confs = array('public.conf', 'private.conf');

foreach($confs as $conf) {
    $conf_file = CONF_PATH . $conf;
    $conf_handle = @fopen($conf_file, 'r');
    if($conf_handle) {
        while(!feof($conf_handle)) {
            $temp_line = trim(fgets($conf_handle, MAX_LENGTH));
            if($temp_line{0} == '#' || empty($temp_line)) {
                continue;
            }
            list($key, $value) = split('=', $temp_line);
            $key = trim($key);
            $value = trim($value);
            if($value == 'NULL') $value = '';
            if(is_int($value)) $value = intval($value);
            define($key, $value);
        }
    }
}
/* 设置默认值 */
defined('PROJECT_NAME') or define('PROJECT_NAME', 'sitemap-auto');
defined('FROM_NAME') or define('FROM_NAME', 'sitemap-auto');
