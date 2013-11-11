<?php

class UserController extends ConnectedController
{
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionCreate()
	{
		$model = new User();
		$this->saveModel($model);
		$this->render('create', array(
			'model'=>$model,
		));
	}
	
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		$this->saveModel($model);
		$this->render('update', array(
			'model'=>$model,
		));
	}
	
	public function actionDelete($id)
	{
		if(!Yii::app()->request->isPostRequest)
			throw new CHttpException(400, "Invalid request");
		$model = $this->loadModel($id);
		if(!$model->delete())
			throw new CHttpException(500, "Failed to delete user");
		$this->redirect(array('index'));
	}
	
	protected function loadModel($id)
	{
		$model = User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404, "Not found");
		return $model;
	}
	
	protected function saveModel($model)
	{
		if(isset($_POST['User']))
		{
			$model->attributes = $_POST['User'];
			if($model->save())
				$this->redirect(array('index'));
		}
	}
}
