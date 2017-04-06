<?php
require_once(dirname(__FILE__)."/ConfTransformer.php");
// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>SRC_PATH,
	'name'=>'My Console Application',
	
	// autoloading model and component classes
  'import'=>array(
    'application.models.*',
    'application.components.*',
        'application.extensions.*'
  ),
	// application components
	'components'=>array(
		 'user'=>array(
      // enable cookie-based authentication
      'allowAutoLogin'=>true,
      'class'=> 'SWebUser',
      'sso' => ["itebeta.baidu.com", 443],
      'handleLogout' => array('itebeta.baidu.com')
      /*
      'handleLogout' => array('m1-ite-uuap01.m1.baidu.com', 'm1-ite-uuap02.m1.baidu.com', 'bb-iit-uuap01.bb01.baidu.com', 'bb-iit-uuap02.bb01.baidu.com'),
*/   ),
		'userInfo'=>array(
         'class' => 'UuapUic',
         'service'=> 'http://itebeta.baidu.com:8102',
				 'auth'=> 'http://schemas.xmlsoap.org/wsdl/soap/',
				 'appKey'=>'UICWSTestKey'
    ),
		'db'=>array(
      'connectionString' => 'mysql:host='.DB_HOSTS.';dbname='.DB_NAME.';port='.DB_PORT,
      'emulatePrepare' => true,
      'username' => DB_USERNAME,
      'password' => DB_PASSWORD,
      'charset' => 'utf8',
    ),
		'piedb'=>array(
      'class'=>'CDbConnection',
      'connectionString' => 'mysql:host='.PIEDB_HOSTS.';dbname='.PIEDB_NAME.';port='.PIEDB_PORT,
      'emulatePrepare' => true,
      'username' => PIEDB_USERNAME,
      'password' => PIEDB_PASSWORD,
      'charset' => 'utf8',
    ),
    'uaq' => array(
        'class' => 'Uaq',
        'service' => "http://10.224.162.69:8080/",
        'tpl' => "zhanzhang"
    ),
    'simpleCurl' => array(
        'class' => 'SimpleCurl',
    ),
    'scan' => array(
        'class' => 'ScanSafe',
        'service' => 'http://cq01-testing-ssl142.vm.baidu.com',
    )
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
	),
);
