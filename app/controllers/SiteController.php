<?php

class SiteController extends Controller
{
	
	public $defaultAction = 'login';
	
	public function actionLogin()
	{
		if(!Yii::app()->user->isGuest)
			$this->redirect(array('home/index'));
		
		$model = new LoginForm();
		if(isset($_POST['LoginForm']))
		{
			$model->attributes = $_POST['LoginForm'];
			if($model->validate() && $model->login())
				$this->redirect(isset($_GET['return']) ? $_GET['return'] : array('home/index'));
		}
		$this->render('login', array(
			'model'=>$model,
		));
	}
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(array('login'));
	}
	
	public function actionError()
	{
		if($error = Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    	{
	    		echo $error['message'];
	    	}
	    	else
	    	{
	        	$this->render('error', $error);
	    	}
	    }
		else
		{
			$this->redirect(array('index'));
		}
	}
}
