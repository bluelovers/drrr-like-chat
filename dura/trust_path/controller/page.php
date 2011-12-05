<?php

/**
 * @author bluelovers
 * @copyright 2011
 */

class Dura_Controller_Page extends Dura_Abstract_Controller {

	public function main() {
		parent::main();

		$this->_main_action_about();
	}

	protected function _main_action_about() {

		Dura::$action = 'about';

		$this->_view();
		Dura::_exit();
	}

}

?>