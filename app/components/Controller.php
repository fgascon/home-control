<?php

class Controller extends CController
{
	
	public $assets;
	
	public function init()
	{
		parent::init();
		Yii::app()->clientScript->registerPackage('jquery');
		$this->assets = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.assets'), false, -1, YII_DEBUG);
	}
}