<?php

return array(
	
	'components'=>array(
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		'db'=>array(
            'connectionString'=>'mysql:host=127.0.0.1;dbname=home-control',
            'username'=>'home-control',
            'password'=>'9SW4uzjVVYX3RzUB',
            'emulatePrepare'=>true, 
		),
	),
);