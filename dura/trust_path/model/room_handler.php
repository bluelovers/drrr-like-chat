<?php

class Dura_Model_RoomHandler extends Dura_Class_XmlHandler
{
	protected $className = 'Dura_Model_Room';
	protected $fileName  = 'room';

	public function loadAll()
	{
		$path = DURA_XML_PATH.'/';
		$dir = opendir($path);

		$xmls = array();

		while ( $file = readdir($dir) )
		{
			if ( !is_file($path.$file) or strpos($file, $this->fileName) !== 0 )
			{
				continue;
			}

			$id = str_replace($this->fileName.'_', '', $file);
			$id = str_replace('.xml', '', $id);

			$xml = $this->load($id);

			if ( $xml )
			{
				$xmls[$id] = $xml;
			}
		}

		closedir($dir);

		return $xmls;
	}

	protected function _getDefaultXml()
	{
		return
		'<?xml version="1.0" encoding="UTF-8"?>
		<room>
		<name></name>
		<update></update>
		<limit></limit>
		<password>0</password>
		</room>';
	}

	// bluelovers
	public function load($id) {
		$xml = parent::load($id);

		$this->setPassword($xml, $xml->password);

		return $xml;
	}

	public function save($id, $xml) {

		$this->setPassword($xml, $xml->password);

		$_ret = parent::save($id, $xml);

		return $_ret;
	}

	public function setPassword(&$xml, $password = 0) {
		$xml->password = (string)$password;

			$xml->password = trim(Dura::removeCrlf($xml->password));

			if (empty($xml->password)) {
				$xml->password = 0;
			}

		return $xml;
	}

	public function checkPassword(&$roomModel, &$user) {
		$ret = false;

		if (
			!isset($roomModel->password)
			|| empty($roomModel->password)
			|| $roomModel->password == $user->getPasswordRoom()
		) {
			$ret = true;
		}

		return $ret;
	}
	// bluelovers
}

?>
