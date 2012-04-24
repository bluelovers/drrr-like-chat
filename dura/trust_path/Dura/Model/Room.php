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
			'room' => (string)$this->roomModel->name,
			'id' => $this->id,
		), (array)$extra);

		$arr = array(Dura::$controller, $action, (array)$extra);

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
		return $this->user;
	}
}

?>