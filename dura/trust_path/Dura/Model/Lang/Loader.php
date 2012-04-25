<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Model_Lang_Loder extends Dura_Class_Array
{

	function __construct($lang)
	{
		parent::__construct();

		$this->load($lang);
	}

	function load($lang)
	{
		$langFile = DURA_TRUST_PATH . '/language/' . $lang . '.php';
		$catalog = require $langFile;

		$this->exchangeArray((array)$catalog);

		$this->_langcode_ = $lang;
	}

	function &getInstance($lang)
	{
		return new self($lang);
	}

}
