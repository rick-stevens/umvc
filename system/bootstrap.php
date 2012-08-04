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

RSMVC::$config = $config;

if (RSMVC::$config['development']) {
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	ini_set('log_errors', 'Off');
} else {
	error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
	ini_set('display_errors', 'Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', ROOT . 'system/tmp/logs/error.log');
}

spl_autoload_register(array('RSMVC', 'autoload'));

// Dissect and store the URL segments, handle routing/redirects, handle error pages and call the controller.
RSMVC::init();