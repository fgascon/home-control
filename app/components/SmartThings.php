<?php

class SmartThings extends CApplicationComponent
{
	const ENDPOINT = "https://graph.api.smartthings.com";
	
	public $client;
	public $secret;
	
	private $_endpoints;
	public function getEndpoints()
	{
		if($this->_endpoints === null)
		{
			$endpointsData = $this->makeCall('/api/smartapps/endpoints/'.$this->client, array(
				'access_token'=>$this->getAccessToken(),
			));
			$endpoints = array();
			foreach($endpointsData as $endpointData)
				$endpoints[] = new SmartThingsEndpoint($this, $endpointData);
			$this->_endpoints = $endpoints;
		}
		return $this->_endpoints;
	}
	
	private $_accessToken;
	public function getAccessToken()
	{
		if($this->_accessToken === null)
		{
			$cacheName = __CLASS__.'.accessToken';
			$accessToken = Yii::app()->cache->get($cacheName);
			if(!$accessToken)
			{
				$returnUrl = Yii::app()->request->hostInfo.Yii::app()->request->url;
				if(isset($_REQUEST['code']))
				{
					$returnUrl = substr($returnUrl, 0, strpos($returnUrl, 'code='.$_REQUEST['code'])-1);
					$result = $this->makeCall('/oauth/token', array(
						'grant_type'=>'authorization_code',
						'client_id'=>$this->client,
						'client_secret'=>$this->secret,
						'redirect_uri'=>$returnUrl,
						'code'=>$_REQUEST['code'],
						'scope'=>'app',
					));
					if(!isset($result['access_token']))
						throw new CException("Unable to get access token: ".var_export($result, true));
					$accessToken = $result['access_token'];
					$expiresIn = (int) $result['expires_in'];
					if($expiresIn > 300)
						$expiresIn -= 60;
					Yii::app()->cache->set($cacheName, $accessToken, $expiresIn);
				}
				else
				{
					Yii::app()->controller->redirect($this->createUrl('/oauth/authorize', array(
						'client_id'=>$this->client,
						'redirect_uri'=>$returnUrl,
						'response_type'=>'code',
						'scope'=>'app',
					)));
				}
			}
			return $this->_accessToken = $accessToken;
		}
		else
			return $this->_accessToken;
	}
	
	public function createUrl($path, $params=array())
	{
		$url = self::ENDPOINT.$path;
		if(!empty($params))
			$url .= '?'.$this->encodeUrlParams($params);
		return $url;
	}
	
	public function makeAuthCall($path, $params=array())
	{
		$accessToken = $this->getAccessToken();
		$params['access_token'] = $accessToken;
		$result = $this->makeCurlRequest(array(
			CURLOPT_URL=>$this->createUrl($path, $params),
			CURLOPT_HTTPHEADER=>array(
				'Content-Type: application/json',
				'Authorization: Bearer '.$accessToken,
			),
		));
		if(isset($result['error_description']))
			throw new CException($result['error_description']);
		return $result;
	}
	
	public function makeCall($path, $params=array())
	{
		$result = $this->makeCurlRequest(array(
			CURLOPT_URL=>$this->createUrl($path, $params),
			CURLOPT_HTTPHEADER=>array(
				'Content-Type: application/json',
			),
		));
		if(isset($result['error_description']))
			throw new CException($result['error_description']);
		return $result;
	}
	
	private function encodeUrlParams($params)
	{
		$encodedParams = array();
		foreach($params as $key=>$value)
			$encodedParams[] = $key.'='.urlencode($value);
		return implode('&', $encodedParams);
	}
	
	private function makeCurlRequest($options)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);
		$errno = curl_errno($ch);
		$error = curl_error($ch);
		curl_close($ch);
		
		if($errno !== 0)
			throw new CException($error, $errno);
		
		return CJSON::decode($result);
	}
}
