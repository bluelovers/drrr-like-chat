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

class Dura_Model_Room extends Dura_Class_Xml
{
	public function asArray()
	{
		$result = array();

		$result['name']   = (string) $this->name;
		$result['update'] = (int) $this->update;
		$result['limit']  = (int) $this->limit;
		$result['host']   = (string) $this->host;
		$result['language'] = (string) $this->language;

		if ( isset($this->talks) )
		{
			foreach ( $this->talks as $talk )
			{
				$result['talks'][] = (array) $talk;
			}
		}

		foreach ( $this->users as $user )
		{
			$result['users'][] = (array) $user;
		}

		return $result;
	}

	// bluelovers
	public function _talks_add($attr = array()) {
		$talk = $this->addChild('talks');

		foreach((array)$attr as $_k => $_v) {
			$talk->addChild($_k, $_v);
		}

		$this->_talks_handler($talk);

		return $talk;
	}

	public function _talks_handler(&$talk) {

		static $_map;

		if (!isset($_map)) {
			@include DURA_TRUST_PATH.'/resource/colors.php';

			$_map = array();

			$_map['icon_color'] = (array)$_icon_color;
		}

		if ($talk->icon && empty($talk->color)) {
			$talk->color = empty($_map['icon_color'][(string)$talk->icon]) ? 'gray' : $_map['icon_color'][(string)$talk->icon];
		}

		return $talk;
	}
	// bluelovers

}

?>
