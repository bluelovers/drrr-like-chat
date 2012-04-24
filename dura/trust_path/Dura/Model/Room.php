<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Model_Room
{

	var $id = null;

	/**
	 * @var Dura_Model_Room_XmlHandler
	 */
	var $roomHandler = null;

	/**
	 * @var Dura_Model_Room_Xml
	 */
	var $roomModel = null;

	var $error = null;


	/**
	 * @return Dura_Model_Room
	 */
	public static function fromSession($id = null)
	{
		if (Dura_Model_Room_Session::isCreated())
		{
			$id = Dura_Model_Room_Session::get('id');
		}

		return self::fromID($id);
	}

	/**
	 * @return Dura_Model_Room
	 */
	public static function fromID($id)
	{
		return new self($id);
	}

	function __construct($id)
	{
		$this->roomHandler = new Dura_Model_Room_XmlHandler;

		if ($id) $this->load($id);

		return $this;
	}

	function load($id)
	{
		$this->id = $id;
		$this->roomModel = $this->roomHandler->load($id);

		return $this;
	}

	function getID()
	{
		return $this->id;
	}

	/**
	 * check room exists
	 *
	 * @return bool
	 */
	function exists()
	{
		if ($this->roomModel)
		{
			return true;
		}
	}

	/**
	 * @return Dura_Model_Room
	 */
	function session_destroy()
	{
		Dura_Model_Room_Session::delete();

		return $this;
	}

	/**
	 * build room url
	 *
	 * @return string|array - url
	 */
	function url($returnarray = false, $action = null, $extra = array())
	{
		$extra = array_merge(array(
			'room' => (string )$this->roomModel->name,
			'id' => $this->id,
			), (array )$extra);

		$arr = array(
			Dura::$controller,
			$action,
			(array )$extra);

		return $returnarray ? $arr : Dura::url($arr);
	}

	/**
	 * @param Dura_Class_User $user
	 */
	function setUser(&$user)
	{
		$this->user = &$user;

		return $this;
	}

	/**
	 * @return Dura_Class_User
	 */
	function getUser()
	{
		if ($this->user === null)
		{
			$this->setUser(Dura::user());
		}

		return $this->user;
	}

	/**
	 * @param string|Dura_Class_User $pass
	 */
	function isAllowLogin($pass = null)
	{

		if ($pass instanceof Dura_Class_User)
		{
   			$pass = $pass->getPasswordRoom();
		}
		elseif (!$pass && $this->getUser())
		{
			$pass = $this->getUser()->getPasswordRoom();
		}

		$_login_ok = $this->roomHandler->checkPassword($this->roomModel, $pass);

		if ($_login_ok)
		{
			$_login_ok = $this->chkLimit();
		}

		return $_login_ok;
	}

	function chkLimit()
	{
		if (count($this->roomModel->users) >= (int)$this->roomModel->limit)
		{
			return false;
		}

		return true;
	}

	function isHost($userId = null)
	{
		if ($userId === null)
		{
			$userId = (string )$this->getUser()->getId();
		}

		return ($userId == (string )$this->roomModel->host);
	}

	function chkRoomUserExpire()
	{
		foreach ($this->roomModel->users as $_k => $user)
		{
			if ($user->update < REQUEST_TIME - DURA_CHAT_ROOM_EXPIRE)
			{
				$userName = (string )$user->name;

				if ($this->isHost($user->id))
				{
					$changeHost = true;
				}

				$unsetUsers[$_k] = $user;
			}
		}

		foreach ($unsetUsers as $_k => $user)
		{
			$this->_talk_message(array(
				'name' => $user->name,
				'message' => '{1} lost the connection.',
				));

			unset($this->roomModel->users[$_k]);
		}
	}

	function _talk_message($userName, $message)
	{
		if (!is_array($userName))
		{
			$userName = array(
				'name' => (string )$userName,
				'message' => (string )$message,
				);
		}

		$this->roomModel->_talks_add((array )$userName);

		return $this;
	}

}


?>