<?php

/**
 * A simple description for this script
 *
 * PHP Version 5.2.0 or Upper version
 *
 * @package    Dura
 * @author     Hidehito NOZAWA aka Suin <http://suin.asia>
 * @copyright  2010 Hidehito NOZAWA
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GNU GPL v3
 *
 */

abstract class Dura_Abstract_Controller
{
	protected $output = array();
	protected $template = null;

	protected $error = null;

	public $allowActions = array();

	public function __construct()
	{
	}

	public function main()
	{
		// bluelovers
		$this->_main_before();

		if (!empty(Dura::$action))
		{

			if (Dura::$action != Dura::DEFAULT_ACTION && !empty($this->allowActions) && !in_array(Dura::$action, $this->allowActions))
			{
				Dura::$action = Dura::DEFAULT_ACTION;
			}

			$_method = '_main_action_' . Dura::$action;

			if (method_exists($this, $_method))
			{
				$this->$_method();
			}
		}

		$this->_main_after();
		// bluelovers
	}

	function _main_before()
	{

	}

	function _main_after()
	{

	}

	function _getTplFile($template)
	{
		$t = str_replace(DURA_TEMPLATE_PATH, DURA_TEMPLATE_PATH.'/../tpl/', $template);

		if (file_exists($t))
		{
			$template = $t;
		}

		return $template;
	}

	protected function _view()
	{

		if (!$this->template)
		{
			$this->template = DURA_TEMPLATE_PATH . '/' . Dura::$controller . '.' . Dura::$action . '.php';
		}

		// debug new tpl
		$this->template = $this->_getTplFile($this->template);

		$this->_escapeHtml($this->output);

		/*
		ob_start();
		$this->_display($this->output);
		$content = ob_get_contents();
		ob_end_clean();
		*/
		$content = Dura_Abstract_View::render($this->output, $this->template);

		$content->output();
	}

	protected function _display($dura)
	{
		require $this->template;
	}

	protected function _render($content, $dura)
	{
		/*
		require $this->_getTplFile(DURA_TEMPLATE_PATH . '/theme.php');
		*/
		echo Dura_Abstract_View::render($dura, $this->_getTplFile(DURA_TEMPLATE_PATH . '/theme.php'), $content);
	}

	protected function _validateUser($chk = false)
	{
		if (Dura::user()->isUser() == $chk)
		{
			Dura::redirect();
		}
	}

	protected function _validateAdmin()
	{
		if (!Dura::user()->isAdmin())
		{
			Dura::redirect();
		}
	}

	protected function _escapeHtml(&$vars)
	{
		foreach ($vars as $key => &$var)
		{
			if (is_array($var))
			{
				$this->_escapeHtml($var);
			}
			elseif (!is_object($var))
			{
				$var = Dura::escapeHtml($var);
			}
		}
	}

	function _header()
	{
		Dura_Model_Http::header('Content-Type: ' + Dura_Model_Http::getContentType((string)$this->dataType) + '; charset=' . Dura::CHARSET);
	}
}


?>