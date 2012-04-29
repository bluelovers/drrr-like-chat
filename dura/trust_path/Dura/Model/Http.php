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
		if (0)
		{
			echo $string.'<br/>';
			return;
		}

		return @header($string, $replace, $http_response_code);
	}

	function getContentType($type = 'html')
	{
		return isset(self::$map['contenttype'][$type]) ? self::$map['contenttype'][$type] : self::$map['contenttype']['html'];
	}

}
