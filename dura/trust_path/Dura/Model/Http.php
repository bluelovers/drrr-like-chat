<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Model_Http
{

	public static $map = array(
		'contenttype' => array(
			'json' => 'application/json',
			'xml' => 'application/xml',
			'html' => 'text/html',
		),
	);

	static function header($string, $replace = true, $http_response_code = null)
	{
		return @header($string, $replace, $http_response_code);
	}

	static function expires($seconds = 60, $last_modified = 0, $now = 0)
	{
		return Dura_Model_Http_Expires::check($seconds, $last_modified, $now);
	}

	function getContentType($type = 'html')
	{
		return isset(self::$map['contenttype'][$type]) ? self::$map['contenttype'][$type] : self::$map['contenttype']['html'];
	}

}
