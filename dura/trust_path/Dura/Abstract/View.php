<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

abstract class Dura_Abstract_View
{
	protected $output = array();
	protected $template = null;

	function __construct(&$controller)
	{
		$this->output = &$controller->output;
		$this->template = $controller->template;
	}

	static function render(&$controller)
	{
		ob_start();
		$this->_display($this->output);
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	protected function _display($dura)
	{
		require $this->template;
	}

	function set($k, $v)
	{
		$this->output[$k] = $v;

		return $this;
	}

	function get($k)
	{
		return $this->output[$k];
	}
}