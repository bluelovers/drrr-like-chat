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

/*
if ( file_exists('setting.php') )
{
	require 'setting.php';
}
else
{
	require 'setting.dist.php';
}

require 'dura.php';
*/
require_once dirname(__file__).'/trust_path/bootstrap.php';

Dura::setup();
Dura::execute();
