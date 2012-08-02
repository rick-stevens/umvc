<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// Default settings, don't change these.
$config = array(
	'development' => FALSE,
	'httpRoot' => (($_SERVER['HTTPS'] == 'on' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '/'
);

// Overwrite any default settings with the app's config.php:
require_once ROOT . 'app/configs/config.php';
require_once ROOT . 'system/Core.php';

Core::setConfig($config);

if (Core::getConfig('development')) {
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	ini_set('log_errors', 'Off');
} else {
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
	ini_set('display_errors', 'Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', ROOT . 'system/tmp/logs/error.log');
}

spl_autoload_register(array('Core', 'autoload'));

// Route or redirect the URL and store an associative array.
Core::routeInput(isset($_GET['_url']) ? $_GET['_url'] : '');

// Route Apache's error documents.
if (isset($_GET['errorPage']) && array_key_exists($_GET['errorPage'], Helper::$errorCodes))
	Helper::showErrorPage($_GET['errorPage']);

// Call the appropriate controller and method, else 404.
Core::callHook();