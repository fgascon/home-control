<?php

class UserIdentity extends CUserIdentity
{
	
	private $_id;
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function authenticate()
	{
		$user = User::model()->findByAttributes(array(
			'username'=>$this->username,
		));
		if($user === null)
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		else
		{
			$this->_id = $user->id;
			if(!$user->testPassword($this->password))
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			else
			{
				$this->errorCode = self::ERROR_NONE;
				$this->setState('realName', $user->name);
				$this->setState('_is_admin', !!$user->is_admin);
			}
		}
		return $this->errorCode === self::ERROR_NONE;
	}
}