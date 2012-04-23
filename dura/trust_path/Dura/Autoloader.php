<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

class Dura_Autoloader extends Zend_Loader_Autoloader
{
	protected static $_instance;

	/**
	 * @var array Default autoloader callback
	 */
	protected $_defaultAutoloader = array('Zend_Loader', 'loadClass');

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

		if (empty($autoloaders)) return false;

		foreach ($self->getClassAutoloaders($class) as $autoloader)
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
				if (call_user_func($this->_defaultAutoloader, $class, $autoloader))
				{
					return true;
				}
			}
		}

		return false;
	}
}
