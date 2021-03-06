<?php

class Dura_Model_Room_XmlHandler extends Dura_Class_XmlHandler
{
	protected $className = 'Dura_Model_Room_Xml';
	protected $fileName = 'room';

	public function loadAll()
	{
		$path = DURA_XML_PATH . '/';
		$dir = opendir($path);

		$xmls = array();

		while ($file = readdir($dir))
		{
			if (!is_file($path . $file) or strpos($file, $this->fileName) !== 0)
			{
				continue;
			}

			$id = str_replace($this->fileName . '_', '', $file);
			$id = str_replace('.xml', '', $id);

			$xml = $this->load($id);

			if ($xml)
			{
				$xmls[$id] = $xml;
			}
		}

		closedir($dir);

		return $xmls;
	}

	// bluelovers
	public function create()
	{
		$xml = parent::create();

		if (!defined('TIMESTAMP'))
		{
			define('TIMESTAMP', time());
		}

		$xml->create = TIMESTAMP;

		return $xml;
	}
	// bluelovers

	protected function _getDefaultXml()
	{
		return '<?xml version="1.0" encoding="UTF-8"?>
		<room>
		<name></name>
		<update></update>
		<limit></limit>
		</room>';
	}

	// bluelovers
	public function load($id)
	{
		$xml = parent::load($id);

		if (!$xml) return false;

		$this->setPassword($xml, $xml->password);

		return $xml;
	}

	public function save($id, $xml)
	{

		$this->setPassword($xml, $xml->password);

		$_ret = parent::save($id, $xml);

		return $_ret;
	}

	public function setPassword(&$xml, $password = 0)
	{
		$password = (string )$password;

		$password = trim(Dura::removeCrlf($password));

		if (empty($password))
		{
			$password = 0;
		}

		$xml->password = $password;

		return $xml;
	}

	public function checkPassword($roomModel, $input_password)
	{
		$ret = false;

		$password = (string )$roomModel->password;

		if (!isset($password) || empty($password) || $password == (string )$input_password)
		{
			$ret = true;
		}

		return $ret;
	}
	// bluelovers
}
