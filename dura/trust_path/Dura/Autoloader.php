<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Autoloader extends Zend_Loader_Autoloader
{
	protected static $_instance;

	public $error = null;

	/**
	 * @var array Supported namespaces 'Zend' and 'ZendX' by default.
	 */
	protected $_namespaces = array();

	/**
	 * @var array Default autoloader callback
	 */
	protected $_defaultAutoloader = array('Zend_Loader', 'loadClass');

	/**
	 * Constructor
	 *
	 * Registers instance with spl_autoload stack
	 *
	 * @return void
	 */
	protected function __construct()
	{
		Zend_Loader_Autoloader::getInstance()->unshiftAutoloader(array(__CLASS__, 'autoload'));
	}

	/**
	 * Retrieve singleton instance
	 *
	 * @return Dura_Autoloader
	 */
	public static function getInstance()
	{
		if (null === self::$_instance)
		{
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Reset the singleton instance
	 *
	 * @return void
	 */
	public static function resetInstance()
	{
		self::$_instance = null;
	}

	/**
	 * Autoload a class
	 *
	 * @param  string $class
	 * @return bool
	 */
	public static function autoload($class)
	{
		$self = self::getInstance();

		$autoloaders = array();

		foreach ($self->getRegisteredNamespaces() as $ns)
		{
			$ns_ = rtrim($ns, '_');

			if ($class == $ns_ || 0 === strpos($class, $ns))
			{
				$autoloaders = $self->getNamespaceAutoloaders($ns);

				break;
			}
		}

		if (empty($autoloaders) || empty($ns)) return false;

		foreach ($autoloaders as $autoloader)
		{
			try
			{

				if ($autoloader instanceof Zend_Loader_Autoloader_Interface)
				{
					if ($autoloader->autoload($class))
					{
						return true;
					}
				}
				elseif (is_callable($autoloader))
				{
					if (call_user_func($autoloader, $class))
					{
						return true;
					}
				}
				elseif (is_string($autoloader))
				{
					if (@call_user_func($self->_defaultAutoloader, $class, $autoloader))
					{
						return true;
					}

				}

			}
			catch (Exception $e)
			{
				$self->error[$ns][] = $e->getMessage();
			}
		}

		return false;
	}

	/**
	 * Set autoloaders for a specific namespace
	 *
	 * @param  array $autoloaders
	 * @param  string $namespace
	 * @return Zend_Loader_Autoloader
	 */
	protected function _setNamespaceAutoloaders(array $autoloaders, $namespace)
	{
		parent::_setNamespaceAutoloaders($autoloaders, $namespace);

		$this->registerNamespace($namespace);

		return $this;
	}

	/**
	 * Append an autoloader to the autoloader stack
	 *
	 * @param  object|array|string $callback PHP callback or Zend_Loader_Autoloader_Interface implementation
	 * @param  string|array $namespace Specific namespace(s) under which to register callback
	 * @return Zend_Loader_Autoloader
	 */
	public function pushAutoloader($callback, $namespace)
	{
		parent::pushAutoloader($callback, $namespace);

		return $this;
	}

	/**
	 * Add an autoloader to the beginning of the stack
	 *
	 * @param  object|array|string $callback PHP callback or Zend_Loader_Autoloader_Interface implementation
	 * @param  string|array $namespace Specific namespace(s) under which to register callback
	 * @return Zend_Loader_Autoloader
	 */
	public function unshiftAutoloader($callback, $namespace)
	{
		parent::pushAutoloader($callback, $namespace);

		return $this;
	}
}
