<?php

class HomeController extends ConnectedController
{
	const API_ENDPOINT = 'http://home.fgascon.com';
	
	public function actionIndex()
	{
		$this->render('index');
	}
}
