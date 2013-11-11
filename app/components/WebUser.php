<?php

class WebUser extends CWebUser
{
	
	
	public function getIsAdmin()
	{
		return true === $this->getState('_is_admin', false);
	}
}
