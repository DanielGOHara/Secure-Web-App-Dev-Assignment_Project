<?php
/**
* Name: KeyAuth
* Description: Checks session key and get db response
* Author: Lewis Harris @ p2419279
* Edited: 05/01/2021
**/
namespace Gobbwobblers;

class KeyAuth
{
    // property declaration
	private $userInfo = array();
	private $exists = false;
	
    //On construction it checks the session key is valid, responds true if valid
    function __construct()
	{
		//create session obj to get session_key
		$session = new SessionWrapper();
		$sessionKey = $session->getSessionData("login_key");
		//check session isset
		if (isset($sessionKey) && strlen($sessionKey) > 0)
		{
			//check if $key exists, get row for user info
			$checkKey = new DatabaseWrapper();
			$checkKey->setProcedure('GetUserByKey');
			$checkKey->setArguments(['key'=>$sessionKey]);
			$result = $checkKey->execute();
			//create session obj to get session_key
			if (isset($result[0]))
			{
				$this->userInfo =
				[
					'id' => $result[0]['id'],
					'username' => $result[0]['username'],
					'email' => $result[0]['email'],
					'lastLogin' => $result[0]['lastlogin']
				];
				$this->exists=true;
			}
		}
		else
		{
			$this->exists=false;
		}
    }
	
	//returns user info
	public function getUserData(): Array
	{
		return $this->userInfo;
	}
	
	//returns the exist var, true if user profile exists via session key
	public function exists(): Bool
	{
		return $this->exists;
	}
}
?>