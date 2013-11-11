<?php

defined('YII_DEBUG') or define('YII_DEBUG', $enviro==='dev');

$basePath = dirname(__FILE__);
$appPath = "$basePath/app";

require_once($basePath.'/framework/yii.php');

$config = CMap::mergeArray(
	include("$appPath/config/main.php"),
	include("$appPath/config/$enviro.php")
);

$app = Yii::createWebApplication($config);
$app->run();