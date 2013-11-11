<?php

return array(
	
	'components'=>array(
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CWebLogRoute',
					'levels'=>'trace',
					'categories'=>'application',
				),
				array(
					'class'=>'CWebLogRoute',
					'levels'=>'error, warning, info',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'trace',
					'categories'=>'application',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning, info',
				),
			),
		),
		'cache'=>array(
			'class'=>'CDummyCache',
		),
		'db'=>array(
			'connectionString'=>'mysql:host=127.0.0.1;dbname=home-control',
			'username'=>'root',
			'password'=>'',
			'emulatePrepare'=>true,
		),
	),
);