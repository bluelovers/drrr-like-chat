<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

if (!function_exists('json_encode'))
{
	function json_encode($data)
	{
		return Zend_Json_Encoder::encode($data);
	}
}

if (!function_exists('json_decode'))
{
	function json_decode($json)
	{
		return Zend_Json_Decoder::decode($json);
	}
}
