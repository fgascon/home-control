<?php

return array(
	'name'=>'home-control',
	'basePath'=>$appPath,
	'sourceLanguage'=>'fr',
	'language'=>'fr',
	
	'preload'=>array('log'),
	
	'import'=>array(
		'application.components.*',
		'application.models.*',
	),
	
	'components'=>array(
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				''=>'site/login',
				'logout'=>'site/logout',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		'errorHandler'=>array(
            'errorAction'=>'/site/error',
        ),
		'cache'=>array(
			'class'=>'CFileCache',
		),
		'user'=>array(
			'class'=>'WebUser',
		),
		'db'=>array(
			'charset'=>'utf8',
		),
	),
);