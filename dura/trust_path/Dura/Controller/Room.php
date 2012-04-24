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

class Dura_Controller_Room extends Dura_Abstract_Controller
{
	protected $id = null;
	protected $chat = null;
	protected $isAjax = null;

	/**
	 * @var Dura_Model_Room_XmlHandler
	 */
	protected $roomHandler = null;

	/**
	 * @var Dura_Model_Room_Xml
	 */
	protected $roomModel = null;

	/**
	 * @var Dura_Model_Room
	 */
	protected $_model = null;

	public function __construct()
	{
		parent::__construct();

		$this->_validateUser();

		$this->_model = Dura_Model_Room::fromSession(Dura::request('id'));

		$this->id = &$this->_model->id;

		if (!$this->id)
		{
			Dura::redirect('lounge');
		}

		$this->roomHandler = &$this->_model->roomHandler;
		$this->roomModel = &$this->_model->roomModel;

		if (!$this->_model->exists())
		{
			$this->_model->session_destroy();

			Dura::trans(t("Room not found.", 'lounge'));
		}

		$this->output['room.url'] = $this->output['tpl.page.header.home.url'] = $this->_model->url();

		$this->output['error'] = &$this->error;
	}

	public function main()
	{

		// bluelovers
		parent::main();
		// bluelovers

		if (Dura::request('login'))
		{
			$this->_login();
		}

		if (!$this->_model->isLogin())
		{
			Dura_Model_Room_Session::delete();
			Dura::redirect('lounge');
		}

		if (Dura::post('logout'))
		{
			$this->_logout();
		}
		elseif (Dura::post('message'))
		{
			$this->_message();
		}
		elseif (isset($_POST['room_name']))
		{
			$this->_changeRoomName();
		}
		elseif (isset($_POST['new_host']))
		{
			$this->_handoverHostRight();
		}
		elseif (isset($_POST['ban_user']))
		{
			$this->_banUser();
		}

		$this->_default();
	}

	function _main_action_login()
	{
		$this->_login();
	}

	protected function _login()
	{
		if ($this->_model->isLogin())
		{
			Dura::redirect('room', null, array('id' => $this->id));

			return;
		}

		// bluelovers
		$_skip_save = false;
		// bluelovers

		if (!$_login_ok = $this->_model->isAllowLogin(Dura::request('login_password')))
		{
			Dura::trans(t("Room is full.", 'lounge'));
		}

		$unsetUsers = array();
		$offset = 0;
		$changeHost = false;

		// bluelovers
		$count_users = count($this->roomModel->users);
		// bluelovers

		foreach ($this->roomModel->users as $user)
		{
			if ($user->update < time() - DURA_CHAT_ROOM_EXPIRE)
			{
				$userName = (string )$user->name;

				$this->_npcDisconnect($userName);

				if ($this->_model->isHost($user->id))
				{
					$changeHost = true;
				}

				$unsetUsers[] = $offset;
			}

			$offset++;
		}

		foreach ($unsetUsers as $unsetUser)
		{
			unset($this->roomModel->users[$unsetUser]);
		}

		// bluelovers
		if ($offset >= $count_users || empty($this->roomModel->users) || !count($this->roomModel->users))
		{
			$_skip_save = true;
		}

		if ($_login_ok)
		{
			// bluelovers

			$userName = Dura::user()->getName();
			$userId = Dura::user()->getId();
			$userIcon = Dura::user()->getIcon();

			foreach ($this->roomModel->users as $user)
			{
				if ($userName == (string )$user->name and $userIcon == (string )$user->icon)
				{
					Dura::trans(t("Same name user exists. Please rename or change icon.", 'lounge'));
				}
			}

			$users = $this->roomModel->addChild('users');
			$users->addChild('name', $userName);
			$users->addChild('id', $userId);
			$users->addChild('icon', $userIcon);
			$users->addChild('update', time());

			// bluelovers
			$_skip_save = false;
		}
		// bluelovers

		if ($changeHost)
		{
			$this->_moveHostRight();
		}

		$this->_npcLogin($userName);

		// bluelovers
		if ($_skip_save)
		{

			if ($_login_ok)
			{
				Dura::redirect('lounge');
			}

		}
		else
		{
			// bluelovers

			$this->roomHandler->save($this->id, $this->roomModel);

			// bluelovers
		}

		if (!$_login_ok)
		{
			$this->error[] = t("ID or password is wrong.");

			$this->_main_action_askpw();

			Dura::redirect($this->_model->url(1, 'askpw'));
		}
		// bluelovers

		Dura_Model_Room_Session::create($this->id);

		// bluelovers
		Dura_Model_Room_Session::updateUserSesstion($this->roomModel, Dura::user());
		// bluelovers

		Dura::redirect($this->_model->url(1));
	}

	function _main_action_logout()
	{
		$this->_logout();
	}

	protected function _logout()
	{
		$userName = Dura::user()->getName();
		$userId = Dura::user()->getId();

		$userOffset = 0;

		foreach ($this->roomModel->users as $user)
		{
			if ($userId == (string )$user->id)
			{
				break;
			}

			$userOffset++;
		}

		unset($this->roomModel->users[$userOffset]);

		if (count($this->roomModel->users))
		{
			$this->_npcLogout($userName);

			if ($this->_model->isHost())
			{
				$this->_moveHostRight();
			}

			$this->roomHandler->save($this->id, $this->roomModel);
		}
		else
		{
			$this->roomHandler->delete($this->id);
		}

		Dura_Model_Room_Session::delete();

		// bluelovers
		Dura::user()->setPasswordRoom();
		// bluelovers

		Dura::redirect('lounge');
	}

	protected function _message()
	{
		$message = Dura::post('message');

		// bluelovers
		$message = htmlspecialchars(htmlspecialchars_decode($message));
		// bluelovers

		$message = preg_replace('/^[ ?€]*(.*?)[ ?€]*$/u', '$1', $message);
		$message = trim($message);

		if (!$message) return;

		if (mb_strlen($message) > DURA_MESSAGE_MAX_LENGTH)
		{
			$message = mb_substr($message, 0, DURA_MESSAGE_MAX_LENGTH) . '...';
		}

		/*
		$talk = $this->roomModel->addChild('talks');
		$talk->addChild('id', md5(microtime().mt_rand()));
		$talk->addChild('uid', Dura::user()->getId());
		$talk->addChild('name', Dura::user()->getName());
		$talk->addChild('message', $message);
		$talk->addChild('icon', Dura::user()->getIcon());
		$talk->addChild('time', time());
		*/
		// bluelovers
		$talk = $this->roomModel->_talks_add(array(
			'id' => md5(microtime() . mt_rand()),
			'uid' => Dura::user()->getId(),
			'name' => Dura::user()->getName(),
			'message' => $message,
			'icon' => Dura::user()->getIcon(),
			'time' => time(),
			));
		// bluelovers

		$id = Dura::user()->getId();

		foreach ($this->roomModel->users as $user)
		{
			if ($id == (string )$user->id)
			{
				$user->update = time();
			}
		}

		while (count($this->roomModel->talks) > DURA_LOG_LIMIT)
		{
			unset($this->roomModel->talks[0]);
		}

		$this->roomHandler->save($this->id, $this->roomModel);

		if (Dura::get('ajax')) die; // TODO

		Dura::redirect($this->_model->url(1));
	}

	// bluelovers
	protected function _main_action_askpw()
	{
		Dura::$action = 'askpw';

		$room = $this->roomModel->asArray();

		$room['url'] = $this->_model->url();

		$room['id'] = $this->id;

		$this->output['room'] = $room;

		$this->_view();
		die();
	}
	// bluelovers

	protected function _default()
	{
		$room = $this->roomModel->asArray();

		$room['talks'] = array_reverse($room['talks']);

		foreach ($room['talks'] as $k => $talk)
		{
			if ($talk['uid'] == 0)
			{
				$name = $talk['name'];
				$room['talks'][$k]['message'] = t($talk['message'], $name);
			}
		}

		$this->output['room'] = $room;

		$this->output['user'] = array(
			'id' => Dura::user()->getId(),
			'name' => Dura::user()->getName(),
			'icon' => Dura::user()->getIcon(),

			// bluelovers
			'color' => Dura::user()->getColor(),
			// bluelovers
			);

		$this->_view();
	}

	protected function _moveHostRight()
	{
		foreach ($this->roomModel->users as $user)
		{
			$this->roomModel->host = (string )$user->id;
			$nextHost = (string )$user->name;
			break;
		}

		$this->_npcNewHost($nextHost);
	}

	protected function _changeRoomName()
	{
		if (!$this->_model->isHost())
		{
			die(t("You are not host."));
		}

		$roomName = Dura::post('room_name');
		$roomName = trim($roomName);

		if ($roomName === '')
		{
			die(t("Room name is blank."));
		}

		if (mb_strlen($roomName) > 10)
		{
			die(t("Name should be less than 10 letters."));
		}

		$this->roomModel->name = $roomName;

		// bluelovers
		$this->_model->_talk_message($roomName, 'Chat room name was changed to {1}');
		// bluelovers

		$this->roomHandler->save($this->id, $this->roomModel);

		die(t("Room name is modified."));
	}

	protected function _handoverHostRight()
	{
		if (!$this->_model->isHost())
		{
			die(t("You are not host."));
		}

		$userId = Dura::post('new_host');

		if ($userId === '')
		{
			die(t("Host is invaild."));
		}

		/*
		$userFound = false;

		foreach ($this->roomModel->users as $user)
		{
			if ($nextHostId == (string )$user->id)
			{
				$userFound = true;
				$nextHost = (string )$user->name;
				break;
			}
		}

		if (!$userFound)
		{
			die(t("User not found."));
		}

		$this->roomModel->host = $nextHostId;

		$this->_npcNewHost($nextHost);

		$this->roomHandler->save($this->id, $this->roomModel);

		die(t("Gave host rights to {1}.", $nextHost));
		*/

		if ($userFound = $this->_model->room_user_remove($userId))
		{
			if (count($userFound) == 1)
			{

				$userName = null;

				foreach((array)$userFound as $user)
				{
					$userName = (string)$user->name;
				}

				$this->_model->save();

				die(t("Gave host rights to {1}.", $userName));
			}
		}

		die(t("User not found."));
	}

	protected function _banUser()
	{
		if (!$this->_model->isHost())
		{
			die(t("You are not host."));
		}

		$userId = Dura::post('ban_user');

		if ($userId == '')
		{
			die(t("User is invaild."));
		}

		/*
		$userFound = false;
		$userOffset = 0;

		foreach ($this->roomModel->users as $user)
		{
			if ($userId == (string )$user->id)
			{
				$userFound = true;
				$userName = (string )$user->name;
				break;
			}

			$userOffset++;
		}

		if (!$userFound)
		{
			die(t("User not found."));
		}

		unset($this->roomModel->users[$userOffset]);

		$this->_npcDisconnect($userName);

		$this->roomHandler->save($this->id, $this->roomModel);

		die(t("Banned {1}.", $userName));
		*/

		if ($userFound = $this->_model->room_user_remove($userId))
		{
			$userName = array();

			foreach((array)$userFound as $user)
			{
				$userName[] = (string)$user->name;

				$this->_npcDisconnect((string)$user->name);
			}

			$userName = implode(', ', $userName);

			$this->_model->save();

			die(t("Banned {1}.", $userName));
		}

		die(t("User not found."));
	}

	protected function _isHost($userId = null)
	{
		return $this->_model->isHost($userId);
	}

	// bluelovers
	protected function _npcTalk($userName, $message)
	{
		$this->_model->_talk_message($userName, $message);

		return $this;
	}
	// bluelovers

	protected function _npcLogin($userName)
	{
		$this->_model->_talk_message($userName, "{1} logged in.");

		return $this;
	}

	protected function _npcLogout($userName)
	{
		$this->_model->_talk_message($userName, "{1} logged out.");

		return $this;
	}

	protected function _npcDisconnect($userName)
	{
		$this->_model->_talk_message($userName, "{1} lost the connection.");

		return $this;
	}

	protected function _npcNewHost($userName)
	{
		$this->_model->_talk_message($userName, "{1} is a new host.");

		return $this;
	}
}


?>