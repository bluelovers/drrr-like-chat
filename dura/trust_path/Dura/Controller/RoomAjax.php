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

	function _chk_expires()
	{
		$session = &Dura_Model_Room_Session::getSelf();

		$_a = (int)$this->roomModel->update;
		$_b = (int)$session['Last-Modified'];

		$ret = ($_a == $_b) ? 1 : 0;

		if ($ret && Dura_Model_Http_Expires::get())
		{
			Dura_Model_Http_Expires::expires(5, $_a);
		}
		else
		{
			$ret = false;
			Dura_Model_Http_Expires::set(2, $_a, time());
		}

		$session['Last-Modified'] = $_a;

		return ($ret);
	}

	function _main_after()
	{
		$this->_chk_login();

		$session = &Dura_Model_Room_Session::getSelf();

		/*
		var_dump(time());

		//$session['Last-Modified'] = 0;

		var_dump('-------------------');

		var_dump(array(
			(int)$session['Last-Modified'],
			(int)$this->roomModel->update,
			$this->_chk_expires(),
		));

		var_dump('-------------------');

		$session['Last-Modified'] = (int)$this->roomModel->update;

		var_dump(array(
			(int)$session['Last-Modified'],
			(int)$this->roomModel->update,
			$this->_chk_expires(),
		));

		var_dump('-------------------');

		$this->roomModel->update = time() + 1;

		var_dump(array(
			(int)$session['Last-Modified'],
			(int)$this->roomModel->update,
			$this->_chk_expires(),
		));

		var_dump('-------------------');

		var_dump(array(
			(int)$session['Last-Modified'],
			(int)$this->roomModel->update,
			$this->_chk_expires(),
		));

		exit();

		$session['Last-Modified'] = 0;
		*/

		if ($this->_chk_expires())
		{
			die();
		}

		$session['Last-Modified'] = (int)$this->roomModel->update;

		$this->roomModel->addChild('error', 0);

		foreach ( $this->roomModel->talks as $talk )
		{
			if ( (string) $talk->uid == 0 )
			{
				$name    = (string) $talk->name;
				$message = (string) $talk->message;

				$talk->message = t($message, $name);
			}

			$talk->message = nl2br((string)$talk->message);
		}

		unset($this->roomModel->password);

		$this->roomModel->addChild('request_time', REQUEST_TIME);

		if ($this->dataType == 'xml')
		{
			echo $this->roomModel->asXML();
		}
		else
		{
			$a = $this->roomModel->asArray();
			$a['request_time'] = REQUEST_TIME;

			echo json_encode($a);
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
			echo('<?xml version="1.0" encoding="' . Dura::CHARSET . '"?><room><error>' . $this->output['error']['error'] . '</error><msg>' . $this->output['error']['msg'] . '</msg></room>');
		}
		else
		{
			echo json_encode($this->output['error']);
		}

		die();
	}

}
