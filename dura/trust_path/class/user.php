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

class Dura_Class_User
{
	protected $name = null;
	protected $icon = null;
	protected $id   = null;
	protected $expire = null;
	protected $admin = false;
	protected $language = null;

	protected function __construct()
	{
	}

	public static function &getInstance()
	{
		static $instance = null;

		if ( $instance === null )
		{
			$instance = new self();
		}

		return $instance;
	}

	public function login($name, $icon, $language, $admin = false, $password_room = null)
	{
		$this->name = $name;
		$this->icon = $icon;
		$this->id = md5($name.getenv('REMOTE_ADDR'));
		$this->language = $language;
		$this->admin = $admin;

		// bluelovers
		if (
			isset($password_room)
			&& $password_room !== null
		) {
			$password_room = empty($password_room) ? 0 : (string) $password_room;

			$this->password_room = $password_room;
		}
		// bluelovers

		$_SESSION['user'] = $this;
	}

	public function loadSession()
	{
		if ( isset($_SESSION['user']) and $_SESSION['user'] instanceof self )
		{
			$user = $_SESSION['user'];
			$this->name   = $user->name;
			$this->icon   = $user->icon;
			$this->id     = $user->id;
			$this->expire = $user->expire;
			$this->id     = $user->id;
			$this->language = $user->language;
			$this->admin  = $user->admin;

			// bluelovers
			$this->password_room = $user->password_room;
			// bluelovers
		}
	}

	public function isUser()
	{
		return ( $this->id !== null );
	}

	public function isAdmin()
	{
		if ( $this->isUser() )
		{
			return $this->admin;
		}

		return false;
	}

	public function getName()
	{
		if ( !$this->isUser() ) return false;

		return $this->name;
	}

	public function getIcon()
	{
		if ( !$this->isUser() ) return false;

		return $this->icon;
	}

	public function getId()
	{
		if ( !$this->isUser() ) return false;

		return $this->id;
	}

	public function getLanguage()
	{
		return $this->language;
	}

	// bluelovers
	public function getColor() {

		if ( !$this->isUser() ) return false;

		if (!isset($this->color)) {
			$this->_handler($this);
		}

		return $this->color;
	}

	public function &_handler(&$user) {

		static $_map;

		if (!isset($_map)) {
			@include DURA_TRUST_PATH.'/resource/colors.php';

			$_map = array();

			$_map['icon_color'] = (array)$_icon_color;
		}

		$icon = $user->getIcon();

		if ($icon && empty($user->color)) {
			$user->color = empty($_map['icon_color'][$icon]) ? 'gray' : $_map['icon_color'][$icon];
		}

		return $user;
	}
	// bluelovers

	public function getExpire()
	{
		if ( !$this->isUser() ) return false;

		return $this->expire;
	}

	public function updateExpire()
	{
		$this->expire = time() + DURA_TIMEOUT;

		if ( isset($_SESSION['user']) and $_SESSION['user'] instanceof self )
		{
			$_SESSION['user']->expire = $this->expire;
		}
	}

	// bluelovers
	public function getPasswordRoom() {

		if ( !$this->isUser() ) return false;

		return $this->password_room;
	}

	public function setPasswordRoom($password = 0) {

		if ( !$this->isUser() ) return false;

		$password = empty($password) ? 0 : (string)$password;
		$this->password_room = $password;

		if ( isset($_SESSION['user']) and $_SESSION['user'] instanceof self )
		{
			$_SESSION['user']->password_room = $password;
		}
	}
	// bluelovers

}

?>
