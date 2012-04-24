<?php

/**
 * @author bluelovers
 * @copyright 2012
 */

define('REQUEST_TIME', time());
$_SERVER['REQUEST_TIME'] = REQUEST_TIME;

if (file_exists(dirname(__file__) . '/bootstrap.options.php'))
{
	include (dirname(__file__) . '/bootstrap.options.php');
}

if (file_exists(dirname(__file__) . '/setting.php'))
{
	require dirname(__file__) . '/setting.php';
}
else
{
	require dirname(__file__) . '/setting.dist.php';
}

error_reporting(0);

require_once ('Zend/Loader/Autoloader.php');

Zend_Loader_Autoloader::getInstance()
	->suppressNotFoundWarnings(true)
;

/*
Zend_Loader::loadClass('Dura_Autoloader', dirname(__file__));

Zend_Loader_Autoloader::getInstance()->pushAutoloader(Dura_Autoloader::getInstance(DURA_TRUST_PATH, 'Dura'));

$pluginLoader = new Zend_Loader_PluginLoader();

$pluginLoader->addPrefixPath('Dura', DURA_TRUST_PATH);

Zend_Loader_Autoloader::getInstance()->pushAutoloader($pluginLoader);
*/

Zend_Loader::loadClass('Dura_Autoloader', DURA_TRUST_PATH);

/*
$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
	'basePath' => DURA_TRUST_PATH . '/Dura',
	'namespace' => 'Dura',
	'resourceTypes' => array(
		'Abstract' => array(
			'path' => 'Abstract/',
			'namespace' => 'Abstract',
		),
		'Class' => array(
			'path' => 'Class/',
			'namespace' => 'Class',
		),
		'Controller' => array(
			'path' => 'Controller/',
			'namespace' => 'Controller',
		),
		'Model' => array(
			'path' => 'Model/',
			'namespace' => 'Model',
		),
		'Resource' => array(
			'path' => 'Resource/',
			'namespace' => 'Resource',
		),
	),
));
*/

Dura_Autoloader::getInstance()
	->pushAutoloader(DURA_TRUST_PATH, 'Dura_')
	->pushAutoloader(array('Dura', 'autoload'), 'Dura_')
;

/*
Zend_Loader_Autoloader::getInstance()
	->pushAutoloader(array('Dura', 'autoload'), 'Dura_')
//	->pushAutoloader(array($resourceLoader, 'autoload'), 'Dura_')
	->unshiftAutoloader(array('Dura_Autoloader', 'autoload'), 'Dura_')
;
*/

if (!class_exists('Dura'))
{
	Zend_Loader::loadFile('dura.php', DURA_TRUST_PATH, true);
}
