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

class Dura_Controller_Logout extends Dura_Abstract_Controller
{

	function _main_before()
	{
		$this->_validateUser();
	}

	function _main_after()
	{
		$this->_main_action_default();
	}

	protected function _main_action_default()
	{
		session_destroy();

		Dura::redirect();
	}

}
