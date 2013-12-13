<?php

class SmartThingsEndpoint extends CComponent
{
	
	private $_apiCaller;
	private $_url;
	
	public function __construct($apiCaller, $data)
	{
		$this->_apiCaller = $apiCaller;
		$this->_url = $data['url'];
	}
	
	public function makeCall($path, $params=array())
	{
		return $this->_apiCaller->makeAuthCall($this->_url.$path, $params);
	}
	
	public function createUrl($path, $params=array())
	{
		$apiCaller = $this->_apiCaller;
		$params['access_token'] = $apiCaller->getAccessToken();
		return $apiCaller->createUrl($this->_url.$path, $params);
	}
}
