<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Controller_RoomAjax extends Dura_Abstract_Controller
{

	/**
	 * @var Dura_Model_Room_XmlHandler
	 */
	protected $roomHandler = null;

	/**
	 * @var Dura_Model_Room_Xml
	 */
	protected $roomModel = null;

	/**
	 * @var Dura_Model_Room
	 */
	protected $_model = null;

	public function __construct()
	{
		parent::__construct();

		$this->_model = Dura_Model_Room::fromSession();

		$this->id = &$this->_model->id;
		$this->roomHandler = &$this->_model->roomHandler;
		$this->roomModel = &$this->_model->roomModel;

		$this->dataType = Dura::request('dataType', 'json');

		$this->_header();

		$this->_chk_exists();
	}

	function _main_after()
	{
		$this->_chk_login();

		$this->roomModel->addChild('error', 0);

		foreach ( $this->roomModel->talks as $talk )
		{
			if ( (string) $talk->uid == 0 )
			{
				$name    = (string) $talk->name;
				$message = (string) $talk->message;

				$talk->message = t($message, $name);
			}
		}

		unset($this->roomModel->password);

		Dura_Model_Http_Expires::set($this->roomModel->update);

		if ($this->dataType == 'xml')
		{
			echo $this->roomModel->asXML();
		}
		else
		{
			echo $this->roomModel->asJSON();
		}

		die();
	}

	function _chk_exists()
	{
		if (!$this->id || !$this->_model->exists())
		{
			$this->error['error']  = 2;
			$this->error['msg'] = t("Room was deleted.");

			$this->_msg();
		}
	}

	function _chk_login()
	{
		if (!$this->_model->isLogin())
		{
			$this->_model->session_destroy();

			$this->error['error']  = 3;
			$this->error['msg'] = t("Login error.");

			$this->_msg();
		}
	}

	function _msg($err = array())
	{
		$this->output['error'] = array_merge((array)$this->output['error'], (array)$this->error, (array)$err);

		if ($this->dataType == 'xml')
		{
			echo('<?xml version="1.0" encoding="' . Dura::CHARSET . '"?><room><error>' . $this->output['error']['error'] . '</error></room>');
		}
		else
		{
			echo json_encode($this->output['error']);
		}

		die();
	}

	function _header()
	{
		Dura_Model_Http::header('Content-Type: ' + Dura_Model_Http::getContentType($this->dataType) + '; charset=' . Dura::CHARSET);
	}

}
