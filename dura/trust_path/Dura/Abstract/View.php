<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Abstract_View
{
	var $output = array();
	var $template = null;
	var $content = null;
	var $extend = null;

	function __construct(&$output, $template = null)
	{
		$this->output = &$output;
		$this->template = $template;
	}

	static function render(&$output, $template = null, $content = null)
	{
		$_this = new self($output, $template);

		$_this->content = $content;

		$content = $_this->_view();

		if ($_this->extend)
		{
			$content = self::render($_this->output, self::_getTplFile($_this->extend), $content);
		}

		return $content;
	}

	function slot($name, $content = null)
	{
		echo self::render($this->output, self::_getTplFile($name));
	}

	function _getTplFile($name)
	{
		$template = DURA_TEMPLATE_PATH . '/'.$name.'.php';

		$t = str_replace(DURA_TEMPLATE_PATH, DURA_TEMPLATE_PATH.'/../tpl/', $template);

		if (file_exists($t))
		{
			$template = $t;
		}

		return $template;
	}

	function extend($name)
	{
		$this->extend = $name;
	}

	protected function _view()
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