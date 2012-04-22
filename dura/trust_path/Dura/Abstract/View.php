<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Abstract_View
{
	var $output = array();
	var $template = null;

	function __construct(&$output, $template = null)
	{
		$this->output = &$output;
		$this->template = $template;
	}

	static function render(&$output, $template = null, $content = null)
	{
		$_this = new self($output, $template);

		return $_this->_view($content);
	}

	protected function _view($content = null)
	{
		ob_start();
		$this->_display($this->output, $content);
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	protected function _display($dura, $content = null)
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