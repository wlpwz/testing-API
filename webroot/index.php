<?php

// change the following paths if necessary
$yii='/home/work/yii/yii.php';
$project = dirname(dirname(__FILE__))."/";
require_once($project.'src/libs.php');
$config=$project.'config/main.php';
#require_once($project.'src/libs.php');

// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
 
Yii::createWebApplication($config)->run();
