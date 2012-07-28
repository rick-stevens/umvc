<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

require_once ROOT . 'app/configs/config.php';
require_once ROOT . 'system/Core.php';

Core::setConfig($config);

if (DEVELOPMENT) {
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
Core::routeInput(@$_GET['url']);

// Handle Apache's error documents.
if (isset($_GET['error_page']) && array_key_exists($_GET['error_page'], Helper::$errorCodes))
	Helper::showErrorPage($_GET['error_page']);

// Call the appropriate controller and method, else 404.
Core::callHook();