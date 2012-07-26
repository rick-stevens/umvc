<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

require_once ROOT . 'app/configs/config.php';
require_once ROOT . 'system/Core.php';

if (DEVELOPMENT) {
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	ini_set('log_errors', 'Off');
} else {
	error_reporting(E_ALL ^ E_NOTICE);
	ini_set('display_errors', 'Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', ROOT . 'system/tmp/logs/error.log');
}

spl_autoload_register(array('Core', 'autoload'));

// Handle error documents.
if (isset($_GET['error_page']) && array_key_exists((int)$_GET['error_page'], Helper::$errorCodes))
	Helper::showErrorPage((int)$_GET['error_page']);

// Handle the URL and store an associative array.
Core::setInput(@$_GET['url'], $config['routes']);

// Call the appropriate controller and method.
Core::callHook();