<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

if ( file_exists(dirname(__file__).'/setting.php') )
{
	require dirname(__file__).'/setting.php';
}
else
{
	require dirname(__file__).'/setting.dist.php';
}

if (file_exists(dirname(__file__).'/bootstrap.options.php'))
{
	include(dirname(__file__).'/bootstrap.options.php');
}

require_once ('Zend/Loader/Autoloader.php');

Zend_Loader_Autoloader::getInstance();

/*
Zend_Loader::loadClass('Dura_Autoloader', dirname(__file__));

Zend_Loader_Autoloader::getInstance()->pushAutoloader(Dura_Autoloader::getInstance(DURA_TRUST_PATH, 'Dura'));

$pluginLoader = new Zend_Loader_PluginLoader();

$pluginLoader->addPrefixPath('Dura', DURA_TRUST_PATH);

Zend_Loader_Autoloader::getInstance()->pushAutoloader($pluginLoader);
*/

Zend_Loader::loadFile('dura.php', DURA_TRUST_PATH, true);

Zend_Loader_Autoloader::getInstance()->pushAutoloader(array('Dura', 'autoload'));
