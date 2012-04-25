<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Model_Lang extends Dura_Class_Array
{

	function __construct()
	{

	}

	function getList()
	{
		if (isset($this['list'])) return $this['list'];

		$this['list'] = new Dura_Model_Lang_List();

		foreach ($this['list'] as $langcode => $name)
		{
			if (!file_exists(DURA_TRUST_PATH . '/language/' . $langcode . '.php'))
			{
				unset($this['list'][$langcode]);
			}
		}

		$this['list']->ksort();

		return $this['list'];
	}

	function acceptLang($acceptLangs = null)
	{
		if (!isset($this['list'])) $this->getList();

		if ($acceptLangs === null)
		{
			$acceptLangs = getenv('HTTP_ACCEPT_LANGUAGE') || $_ENV['HTTP_ACCEPT_LANGUAGE'] || $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		}

		//$acceptLangs = 'zh-tw,en-us;q=0.8,ja;q=0.6,en;q=0.4,zh;q=0.2';
		$acceptLangs = explode(',', (string )$acceptLangs);
		$defaultLanguage[80][] = DURA_LANGUAGE;

		foreach ($acceptLangs as $k => $acceptLang)
		{
			@list($langcode, $dummy) = explode(';', $acceptLang);

			parse_str($dummy, $tmp);
			$dummy = isset($tmp['q']) ? $tmp['q'] : ((float)$dummy ? $dummy : 1);
			$dummy = bcmul($dummy, 100.0);

			foreach ($this['list'] as $language => $v)
			{
				if (stripos($language, $langcode) === 0)
				{
					$defaultLanguage[$dummy][] = $language;
					break;
				}
			}
		}

		krsort($defaultLanguage);

		$this['acceptLangs'] = $defaultLanguage;

		return reset(reset($defaultLanguage));
	}
}
