<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Model_Room
{

	protected $id = null;

	/**
	 * @var Dura_Model_Room_XmlHandler
	 */
	protected $roomHandler = null;

	/**
	 * @var Dura_Model_Room_Xml
	 */
	protected $roomModels = null;

	/**
	 * @return Dura_Model_Room
	 */
	public static function fromSession($id = null)
	{
		if (Dura_Model_Room_Session::isCreated())
		{
			$id = Dura_Model_Room_Session::get('id');
		}

		return self::fromId($id);
	}

	/**
	 * @return Dura_Model_Room
	 */
	public static function fromId($id)
	{
		return new self($id);
	}

	function __construct($id)
	{
		$this->roomHandler = new Dura_Model_Room_XmlHandler;

		if ($id) $this->load($id);
	}

	function load($id)
	{
		$this->roomModel = $this->roomHandler->load($id);

		return $this;
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
	function sessionDelete()
	{
		Dura_Model_Room_Session::delete();

		return $this;
	}
}

?>