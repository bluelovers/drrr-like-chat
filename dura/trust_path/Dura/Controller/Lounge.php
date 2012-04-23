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

class Dura_Controller_Lounge extends Dura_Abstract_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	function _main_before()
	{
		$this->_validateUser();

		$this->_redirectToRoom();
	}

	public function main_after()
	{
		$this->_default();
	}

	function _main_action_logout()
	{
		session_destroy();
		Dura::redirect();
	}

	protected function _default()
	{
		$this->_rooms();

		$this->_profile();

		$this->output['create_room_url'] = Dura::url('create_room');

		$this->_view();
	}

	protected function _redirectToRoom()
	{
		if (Dura_Class_RoomSession::isCreated())
		{
			Dura::redirect('room');
		}
	}

	protected function _rooms()
	{
		$roomHandler = new Dura_Model_RoomHandler;
		$roomModels = $roomHandler->loadAll();

		$rooms = array();

		$lang = Dura::user()->getLanguage();
		$rooms[$lang] = array();

		$roomExpire = time() - DURA_CHAT_ROOM_EXPIRE;
		$activeUser = 0;

		// bluelovers
		$_id = Dura::user()->getId();
		// bluelovers

		foreach ($roomModels as $id => $roomModel)
		{
			$room = $roomModel->asArray();

			if ($room['update'] < $roomExpire)
			{
				$roomHandler->delete($id);
				continue;
			}

			$room['creater'] = '';

			foreach ($room['users'] as $user)
			{
				if ($user['id'] == $room['host'])
				{
					$room['creater'] = $user['name'];
				}

				// bluelovers
				if (!empty($user['id']) && $user['id'] == $_id)
				{
					Dura_Class_RoomSession::create($id);

					$this->_redirectToRoom();
				}
				// bluelovers
			}

			$room['id'] = $id;
			$room['total'] = count($room['users']);
			$room['url'] = Dura::url('room');

			$lang = $room['language'];

			$rooms[$lang][] = $room;

			$activeUser += $room['total'];
		}

		unset($roomHandler, $roomModels, $roomModel, $room);

		// bluelovers
		$this->_sort_room($rooms, 'update');
		// bluelovers

		$this->output['rooms'] = $rooms;
		$this->output['active_user'] = $activeUser;
	}

	protected function _profile()
	{
		$user = &Dura::user();
		$icon = $user->getIcon();
		$icon = Dura_Class_Icon::getIconUrl($icon);

		$profile = array(
			'icon' => $icon,
			'name' => $user->getName(),
			);

		$this->output['profile'] = $profile;
	}

	// bluelovers
	protected function _sort_room(&$rooms, $key, $asc = 0)
	{

		$this->temp['sort'] = array(
			'key' => $key,
			'asc' => $asc,
			);

		foreach ($rooms as $_k => $_v)
		{
			usort($rooms[$_k], array($this, '_sort_room_func'));
		}

		return $rooms;
	}

	protected function _sort_room_func($a, $b)
	{
		extract($this->temp['sort']);

		if (is_array($key))
		{
			foreach ($key as $_k)
			{
				if ($a[$_k] == $b[$_k])
				{

				}
				else
				{
					break;
				}
			}
		}
		else
		{
			$_k = $key;

			if ($a[$_k] == $b[$_k])
			{
				return 0;
			}
		}

		if ($asc)
		{
			return ($a[$_k] < $b[$_k]) ? -1 : 1;
		}
		else
		{
			return ($a[$_k] < $b[$_k]) ? 1 : -1;
		}

	}
	// bluelovers

}


?>