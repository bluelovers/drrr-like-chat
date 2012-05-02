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

class Dura
{
	public static $controller;
	public static $action;

	public static $Controller;
	public static $Action;

	public static $roomId;

	public static $catalog = array();
	public static $language = null;

	const DEFAULT_CONTROLLER = 'default';
	const DEFAULT_ACTION = 'default';

	const CHARSET = 'UTF-8';

	public static function setup()
	{
		if (defined('DURA_LOADED')) return;

		define('DURA_VERSION', '1.0.3');

		//		spl_autoload_register(array(__CLASS__, 'autoload'));

		// bluelovers
		self::_ob_start();
		// bluelovers

		session_name(DURA_SESSION_NAME);
		session_start();

		self::user()->loadSession();

		mb_internal_encoding(Dura::CHARSET);

		/*
		$langFile = DURA_TRUST_PATH . '/language/' . self::user()->getLanguage() . '.php';
		self::$language = self::user()->getLanguage();

		if (!file_exists($langFile))
		{
			$langFile = DURA_TRUST_PATH . '/language/' . DURA_LANGUAGE . '.php';
			self::$language = DURA_LANGUAGE;
		}

		self::$catalog = require $langFile;
		*/
		self::setLang();

		define('DURA_LOADED', true);
	}

	function setLang($language = '')
	{
		self::$catalog = Dura_Model_Lang::getInstance()->load(self::user()->getLanguage());
		self::$language = Dura_Model_Lang::getInstance()->catalog_idx;
	}

	public static function execute()
	{
		$controller = self::request('controller', Dura::DEFAULT_CONTROLLER);
		$action = self::request('action', Dura::DEFAULT_ACTION);

		self::$Controller = self::putintoClassParts($controller);
		self::$Action = self::putintoClassParts($action);

		self::$controller = self::putintoPathParts(self::$Controller);
		self::$action = self::putintoPathParts(self::$Action);

		self::$Action[0] = strtolower(self::$Action[0]);

		$class = 'Dura_Controller_' . self::$Controller;

		if (!class_exists($class))
		{
			die("Invalid Access");
		}

		$instance = new $class();
		$instance->main();

		self::user()->updateExpire();

		unset($instance);
	}

	public static function autoload($class)
	{
		if (class_exists($class, false)) return;
		if (!preg_match('/^Dura_/', $class)) return;

		$parts = explode('_', $class);
		$parts = array_map(array(__CLASS__, 'putintoPathParts'), $parts);

		$module = array_shift($parts);

		$class = implode('/', $parts);
		$path = sprintf('%s/%s.php', DURA_TRUST_PATH, $class);

		if (!file_exists($path)) return;

		require $path;
	}

	public static function get($name, $default = null, $removeCrlf = false)
	{
		$request = (isset($_GET[$name])) ? $_GET[$name] : $default;
		if (get_magic_quotes_gpc() and !is_array($request)) $request = stripslashes($request);

		// bluelovers

		$request = Dura::_request_filter($request);

		if ($removeCrlf && !is_array($request))
		{
			$request = Dura::removeCrlf($request);
		}
		// bluelovers

		return $request;
	}

	public static function post($name, $default = null, $removeCrlf = false)
	{
		$request = (isset($_POST[$name])) ? $_POST[$name] : $default;
		if (get_magic_quotes_gpc() and !is_array($request)) $request = stripslashes($request);

		// bluelovers

		$request = Dura::_request_filter($request);

		if ($removeCrlf && !is_array($request))
		{
			$request = Dura::removeCrlf($request);
		}
		// bluelovers

		return $request;
	}

	// bluelovers

	protected static $_pattern_xml = '/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u';

	public static function _request_filter($val)
	{
		if (is_array($val))
		{
			foreach ($val as $k => $v)
			{
				$val[$k] = Dura::_request_filter($v);
			}
		}
		else
		{
			$val = preg_replace(Dura::$_pattern_xml, '', $val);
		}

		return $val;
	}

	public static function request($name, $default = null, $removeCrlf = false)
	{
		$request = isset($_POST[$name]) ? $_POST[$name] : (isset($_GET[$name]) ? $_GET[$name] : $default);
		if (get_magic_quotes_gpc() and !is_array($request)) $request = stripslashes($request);

		// bluelovers

		$request = Dura::_request_filter($request);

		if ($removeCrlf && !is_array($request))
		{
			$request = Dura::removeCrlf($request);
		}
		// bluelovers

		return $request;
	}
	// bluelovers

	public static function putintoClassParts($str)
	{
		$str = preg_replace('/[^a-z0-9_]/', '', $str);
		$str = explode('_', $str);
		$str = array_map('trim', $str);
		$str = array_diff($str, array(''));
		$str = array_map('ucfirst', $str);
		$str = implode('', $str);
		return $str;
	}

	public static function putintoPathParts($str)
	{
		$str = preg_replace('/[^a-zA-Z0-9]/', '', $str);
		$str = preg_replace('/([A-Z])/', '_$1', $str);
		$str = strtolower($str);
		$str = substr($str, 1, strlen($str));
		return $str;
	}

	public static function escapeHtml($string)
	{
		if (is_array($string))
		{
			foreach ($string as $_k => $_v)
			{
				$string[$_k] = self::escapeHtml($_v);
			}

			return $string;
		}

		return htmlspecialchars((string )$string, ENT_QUOTES);
	}

	// bluelovers
	public static function removeCrlf($string)
	{
		return str_replace(array(
			"\r\n",
			"\n\r",
			"\n",
			"\r",
			), array(
			' ',
			' ',
			' ',
			' ',
			), $string);
	}
	// bluelovers

	/**
	 * @param mixed|$controller
	 * @param string|$action
	 * @param array|$extra
	 */
	public static function redirect($controller = null, $action = null, $extra = array())
	{

		if (is_array($controller))
		{
			list($controller, $action, $extra) = $controller;
		}

		$url = self::url((string)$controller, (string)$action, (array)$extra);
		header('Location: ' . $url);
		/*
		die;
		*/
		// bluelovers
		Dura::_exit();
		// bluelovers
	}

	/**
	 * @param mixed|$controller
	 * @param string|$action
	 * @param array|$extra
	 */
	public static function url($controller = null, $action = null, $extra = array())
	{

		if (is_array($controller))
		{
			list($controller, $action, $extra) = $controller;
		}

		$params = array();

		if ($action == Dura::DEFAULT_ACTION)
		{
			unset($action);
		}

		if ($controller == Dura::DEFAULT_CONTROLLER && !$action)
		{
			unset($controller);
		}

		if (DURA_USE_REWRITE || !($controller || $action))
		{
			$url = DURA_URL . '/';
		}
		else
		{
			$url = DURA_URL . '/index.php';
		}

		if ($controller)
		{
			if (DURA_USE_REWRITE)
			{
				$url .= $controller . '/';
			}
			else
			{
				$params['controller'] = $controller;
			}
		}

		if ($action)
		{
			if (DURA_USE_REWRITE)
			{
				$url .= $action . '/';
			}
			else
			{
				$params['action'] = $action;
			}
		}

		if (is_array($extra))
		{
			$params = array_merge($params, $extra);
		}

		$params = array_filter((array)$params);

		if ($param = http_build_query($params))
		{
			$url .= '?' . $param;
		}

		return $url;
	}

	public static function &user()
	{
		$user = &Dura_Class_User::getInstance();
		return $user;
	}

	public static function getUrl()
	{
		if (isset($_SERVER['HTTPS']) and $_SERVER['HTTPS'] == 'on')
		{
			$protocol = 'https://';
		}
		else
		{
			$protocol = 'http://';
		}

		$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		$parts = parse_url($url);

		if (preg_match('/\.php$/', $parts['path']))
		{
			$url = dirname($url);
		}
		elseif (preg_match('/\/$/', $parts['path']))
		{
			$url = substr($url, 0, -1);
		}

		return $url;
	}

	public static function trans($message, $controller = null, $action = null, $extra = array())
	{
		$url = self::url($controller, $action, $extra);


		$url = self::escapeHtml($url);
		$message = self::escapeHtml($message);

		/*
		require DURA_TEMPLATE_PATH.'/trans.php';
		*/
		$output = array(
			'url' => $url,
			'message' => $message,
			);

		$content = Dura_Abstract_View::render($output, Dura_Abstract_View::_getTplFile('trans'));
		$content->output();
		/*
		die;
		*/
		// bluelovers
		Dura::_exit();
		// bluelovers
	}

	// bluelovers
	public static function _exit($status = null)
	{
		die($status);
	}

	public static function _ob_start()
	{
		if (!defined('DURA_OB_HANDLER'))
		{
			define('DURA_OB_HANDLER', 'ob_gzhandler');
		}

		$_ret = false;
		if (DURA_OB_HANDLER)
		{
			$_ret = ob_start(DURA_OB_HANDLER);
		}

		if (!$_ret) $_ret = ob_start();

		return $_ret;
	}
	// bluelovers
}
