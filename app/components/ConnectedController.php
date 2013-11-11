<?php

class ConnectedController extends Controller
{
	
	public $layout = 'connected';
	
	public function init()
	{
		parent::init();
		
		if(Yii::app()->user->isGuest)
			$this->redirect(array('site/login', 'return'=>Yii::app()->request->url));
	}
}
