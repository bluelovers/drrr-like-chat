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

	protected $input = null;

	public $allowActions = array(
		'askpw',
		'options',
		'login',
		'logout',
	);

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

		$this->output['input']['last_talk_time'] = intval(Dura::request('last_talk_time'));

		$this->_model->cache['url']['last_talk_time'] = $this->output['input']['last_talk_time'];

		$this->output['room.url'] = $this->output['tpl.page.header.home.url'] = $this->_model->url();

		$this->output['tpl.header.canonical'] = $this->output['tpl.page.header.home.url'] = $this->_model->url(0, Null, array('last_talk_time' => ''));

		$this->output['error'] = &$this->error;
	}

	function _main_action_options()
	{
		$this->_chk_login();

		if (Dura::post('new_host'))
		{
			$this->_handoverHostRight();
		}
		elseif (Dura::post('ban_user'))
		{
			$this->_banUser();
		}
		elseif (Dura::post('room_name', null, true) && Dura::post('save'))
		{
			$this->_changeRoomName();
		}
	}

	function _chk_login()
	{
		if (!$this->_model->isLogin())
		{
			$this->_model->session_destroy();
			Dura::redirect('lounge');
		}

		$this->output['user.ishost'] = $this->_model->isHost();
	}

	function _main_action_default()
	{
		$this->_chk_login();

		if (Dura::post('logout'))
		{
			$this->_logout();
		}
		elseif (Dura::post('message'))
		{
			$this->_message();
		}
		elseif (isset($_POST['message']))
		{
			$this->output['ajax']['error_msg'] = t("Please input message.");
		}
	}

	function _main_after()
	{
		$this->_default();
	}

	protected function _main_action_login()
	{
		if ($this->_model->isLogin())
		{
			Dura::redirect($this->_model->url(1));

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

			/*
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
			*/

			$this->_model->addUser(Dura::user());

			// bluelovers
			$_skip_save = false;
		}
		// bluelovers

		if ($changeHost)
		{
			$this->_moveHostRight();
		}

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

			$this->_model->save();

			// bluelovers
		}

		if (!$_login_ok)
		{
			$this->error[] = t("ID or password is wrong.");

			$this->_main_action_askpw();

			Dura::redirect($this->_model->url(1, 'askpw'));
		}
		// bluelovers

		$this->_model->session_start();
		$this->_model->session_update(Dura::user());

		Dura::redirect($this->_model->url(1));
	}

	function _main_action_logout()
	{
		$this->_logout();
	}

	protected function _logout()
	{
		$this->_model->removeUser();

		if (count($this->roomModel->users))
		{
			if ($this->_model->isHost())
			{
				$this->_moveHostRight();
			}

			$this->_model->save();
		}
		else
		{
			$this->roomHandler->delete($this->id);
		}

		Dura::redirect('lounge');
	}

	protected function _message()
	{
		$this->input['message'] = Dura::post('message', DURA_MESSAGE_CRLF_REMOVE);

		// bluelovers
		$this->input['message'] = htmlspecialchars(htmlspecialchars_decode($this->input['message']));
		// bluelovers

		$this->input['message'] = preg_replace('/^[\s]*|[\s]*$/', '', $this->input['message']);

		$this->input['message'] = trim($this->input['message']);

		if (!$this->input['message']) {

			$this->output['ajax']['error_msg'] = t("Please input message.");

			return;
		}

		if (mb_strlen($this->input['message']) > DURA_MESSAGE_MAX_LENGTH)
		{
			$this->input['message'] = mb_substr($this->input['message'], 0, DURA_MESSAGE_MAX_LENGTH) . '...';
		}

		$this->_model->_talk_message(array(
			'uid' => Dura::user()->getId(),
			'name' => Dura::user()->getName(),
			'message' => $this->input['message'],
			'icon' => Dura::user()->getIcon(),
			));

		$this->output['ajax']['error'] = 0;
		$this->output['ajax']['talk'] = array(
			'name' => Dura::user()->getName(),
			'message' => $this->input['message'],
			'icon' => Dura::user()->getIcon(),
		);

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

		$this->_model->save();

		$this->_ajax();

		Dura::redirect($this->_model->url(1));
	}

	function _ajax($data = array())
	{
		// TODO:
		if (Dura::request('ajax'))
		{
			$data = array_merge(
				array(
					'error' => 1,
				),
				(array)$data,
				(array)$this->output['ajax']
			);

   			if ($data)
   			{
   				switch(Dura::request('dataType'))
   				{
   					case 'xml':
   					case 'json':
   					default:

   						echo json_encode($data);

   						break;
   				}
   			}

			die;
		}
	}

	function _view($data = array())
	{
		$this->_ajax($data);

		parent::_view();
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
			if (!$this->output['last.talk.time'])
			{
				$this->output['last.talk.time'] = $talk['time'] - 1;
			}

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
			$this->_model->setHost((string)$user->id, (string)$user->name);

			break;
		}
	}

	protected function _changeRoomName()
	{
		if (!$this->_model->isHost())
		{
			die(t("You are not host."));
		}

		$this->input['room_name'] = Dura::post('room_name', '', true);
		$this->input['room_name'] = trim($this->input['room_name']);

		if ($this->input['room_name'] === '')
		{
			die(t("Room name is blank."));
		}

		if (mb_strlen($this->input['room_name']) > 10)
		{
			die(t("Name should be less than 10 letters."));
		}

		if ($this->roomModel->name == $this->input['room_name'])
		{
			return;
		}

		$this->roomModel->name = $this->input['room_name'];

		// bluelovers
		$this->_model->_talk_message($this->input['room_name'], 'Chat room name was changed to {1}');
		// bluelovers

		$this->_model->save();

		die(t("Room name is modified."));
	}

	protected function _handoverHostRight()
	{
		if (!$this->_model->isHost())
		{
			die(t("You are not host."));
		}

		$userId = Dura::post('uid');

		if ($userId === '')
		{
			die(t("Host is invaild."));
		}

		if ($userFound = $this->_model->room_user_find($userId))
		{
			$userName = null;

			foreach((array)$userFound as $user)
			{
				if ($userId == (string)$user['id'])
				{
					$userName = (string)$user['name'];

					$this->_model->setHost($userId, $userName);

					$this->_model->save();

					die(t("Gave host rights to {1}.", $userName));

					break;
				}
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

		$userId = Dura::post('uid');

		if ($userId == '')
		{
			die(t("User is invaild."));
		}

		if ($userFound = $this->_model->removeUser($userId, 1))
		{
			$userName = array();

			foreach((array)$userFound as $user)
			{
				$userName[] = (string)$user['name'];
			}

			$userName = implode(', ', $userName);

			$this->_model->save();

			die(t("Banned {1}.", $userName));
		}

		die(t("User not found."));
	}

	// bluelovers
	protected function _npcTalk($userName, $message)
	{
		$this->_model->_talk_message($userName, $message);

		return $this;
	}
	// bluelovers

	protected function _npcDisconnect($userName)
	{
		$this->_model->_talk_message($userName, "{1} lost the connection.");

		return $this;
	}

}


?>