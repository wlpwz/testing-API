<?php
require_once(dirname(__FILE__)."/ConfTransformer.php");
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>SRC_PATH,
	'name'=>PROJECT_NAME,
	'runtimePath'=>RUNTIME_PATH,

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.extensions.*',
        'application.extensions.popsdk.*',
	),
	'defaultController'=>'default',

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'sitemap',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('172.21.210.*'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'class'=>'application.components.SWebUser',
			'allowAutoLogin'=>true,
			//'sso' => ["itebeta.baidu.com", 443],	
			'sso' => ["uuap.baidu.com", 443],	
			//	'handleLogout' => array("uuap.baidu.com"),	
			'filterSuffix' => 'API',
			'handleLogout' => array('m1-ite-uuap01.m1.baidu.com', 'm1-ite-uuap02.m1.baidu.com', 'bb-iit-uuap01.bb01.baidu.com', 'bb-iit-uuap02.bb01.baidu.com'),
		),
		// uncomment the following to enable URLs in path-format
/*		
		'urlManager'=>array(
			'showScriptName' => false,
			'urlFormat'=>'path',
			'rules'=>array(
			//	'<controller:\w+>/<id:\d+>'=>'<controller>/view',
			//	'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>', 
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
	*/	
        'viewRenderer'=>array(
            'class'=>'application.extensions.yiiext.renderers.smarty.ESmartyViewRenderer',
            'fileExtension' => '.tpl',
            'pluginsDir' => 'application.extensions.yiiext.renderers.smarty.plugins',
            'config'=>array('left_delimiter'=>'{%', 'right_delimiter'=>'%}'),
        ),


        //contect to databasep:
		'db'=>array(
			'connectionString' => 'mysql:host='.DB_HOSTS.';dbname='.DB_NAME.';port='.DB_PORT,
			'emulatePrepare' => true,
			'username' => DB_USERNAME,
			'password' => DB_PASSWORD,
			'charset' => 'utf8',
		),
        'mailer'=>array(
            'class'=>'application.extensions.mailer.EMailer',
            'pathViews' => 'application.views.email',
            'pathLayouts' => 'application.views.email.layouts',
        ),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			//'class'=>'ErrorHandler',
            //'errorAction'=>'error/index',
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'yanglingling01i@baidu.com',
	),
);
