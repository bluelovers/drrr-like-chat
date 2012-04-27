<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

function t($message)
{
	if (isset(Dura::$catalog[$message]))
	{
		$message = Dura::$catalog[$message];
	}

	if (func_num_args() == 1) return $message;

	$params = func_get_args();

	foreach ($params as $i => $param)
	{
		$message = str_replace('{' . $i . '}', $param, $message);
	}

	return $message;
}

function e($string, $escape = false)
{
	echo $escape ? Dura::escapeHtml($string) : $string;
}
