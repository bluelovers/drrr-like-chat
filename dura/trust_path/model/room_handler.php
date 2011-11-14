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
		</room>';
	}

	// bluelovers
	public function load($id) {
		$xml = parent::load($id);

		if (isset($xml->password)) {
			$xml->password = trim(Dura::removeCrlf($xml->password));
			$xml->password = empty($xml->password) ? 0 : $xml->password;
		}

		return $xml;
	}

	public function save($id, $xml) {

		if (isset($xml->password)) {
			$xml->password = trim(Dura::removeCrlf($xml->password));
			$xml->password = empty($xml->password) ? 0 : $xml->password;
		}

		$_ret = parent::save($id, $xml);

		return $_ret;
	}
	// bluelovers
}

?>
