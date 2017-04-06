<?php
define('BASE_PATH', realpath(dirname(__DIR__).'/'));

define('BIN_PATH',  BASE_PATH.'/bin');
define('LOG_PATH',  BASE_PATH.'/log');
define('DATA_PATH', BASE_PATH.'/data');
define('SRC_PATH',  BASE_PATH.'/src');
define('WEBROOT_PATH',  BASE_PATH.'/webroot');
define('RUNTIME_PATH', BASE_PATH.'/runtime');

#define('BIN_PATH', dirname(__FILE__).'/..');
defined('CONFIG') or define('CONFIG', realpath(dirname(dirname(__FILE__)).'/config'));
require_once(SRC_PATH.'/global.php');

