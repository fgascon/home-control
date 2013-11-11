<?php

class User extends ActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'user';
	}
	
	public function rules()
	{
		return array(
			array('name, username', 'required'),
			array('name, username', 'length', 'max'=>255),
			array('is_admin', 'boolean'),
			array('password', 'safe', 'on'=>'insert'),
		);
	}
	
	private function hashPassword($pass)
	{
		return sha1($pass);
	}
	
	public function getPassword()
	{
		return '';
	}
	
	public function setPassword($pass)
	{
		$this->pass = $this->hashPassword($pass);
	}
	
	public function testPassword($pass)
	{
		return $this->pass === $this->hashPassword($pass);
	}
}
