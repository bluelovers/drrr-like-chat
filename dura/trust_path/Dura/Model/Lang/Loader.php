<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Model_Lang_Loader extends Dura_Class_Array
{

	function __construct($lang, $dir = null, $file = null)
	{
		parent::__construct();

		$this->load($lang, $dir, $file);
	}

	function load($lang, $dir = null, $file = null)
	{
		$langFile = ($dir !== null ? $dir : DURA_TRUST_PATH . '/Dura/Resource/Lang/') . ($file !== null ? $file : $lang . '.php');
		$catalog = require $langFile;

		$this->exchangeArray((array)$catalog);

		$this->_langcode_ = $lang;
	}

	function &getInstance($lang, $dir = null, $file = null)
	{
		return new self($lang, $dir, $file);
	}

}
