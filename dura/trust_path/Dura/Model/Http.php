<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Model_Http
{

	static function header($string, $replace = true, $http_response_code = null)
	{
		return @header($string, $replace, $http_response_code);
	}



}
