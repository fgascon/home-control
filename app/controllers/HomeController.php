<?php

class HomeController extends ConnectedController
{
	const API_ENDPOINT = 'http://home.fgascon.com';
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function requestHomeApi($method, $uri, $data=array())
	{
		$options = array(
			CURLOPT_RETURNTRANSFER=>true,
			CURLOPT_HEADER=>false,
		);
		$url = self::API_ENDPOINT.$uri;
		if($method === 'get')
		{
			if(empty($data))
				$url .= '?'.$this->encodeRequestData($data);
		}
		else if($method === 'post')
		{
			$options[CURLOPT_POST] = true;
			$options[CURLOPT_POSTFIELDS] = $this->encodeRequestData($data);
		}
		else
			throw new CException("Invalid method $method");
		$options[CURLOPT_URL] = $url;
		$result = CJSON::decode($this->curlRequest($options));
		if(!$result['success'])
		{
			throw new CException($result['error']);
		}
		return $result;
	}
	
	private function encodeRequestData($data)
	{
		$encodedData = array();
		foreach($data as $key=>$value)
			$encodedData[$key] = urlencode($value);
		return implode('&', $encodedData);
	}
	
	private function curlRequest($options)
	{
		$ch = curl_init();
		curl_setopt_array($ch, $options);
		
		$result = curl_exec($ch);
		
		$errorNo = curl_errno($ch);
		if($errorNo === 0)
		{
			curl_close($ch);
			return $result;
		}
		else
		{
			$error = curl_error($ch);
			curl_close($ch);
			throw CException($error);
		}
	}
}
