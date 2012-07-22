<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

require_once ROOT . '/config/config.php';

if (DEVELOPMENT) {
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	ini_set('log_errors', 'Off');
} else {
	error_reporting(E_ALL);
	ini_set('display_errors', 'Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', ROOT.'/system/tmp/logs/error.log');
}

function __autoload($className)
{
	if (file_exists(ROOT . '/application/controllers/' . $className . '.php')) {
		require_once(ROOT . '/application/controllers/' . $className . '.php');
	} else if (file_exists(ROOT . '/application/models/' . $className . '.php')) {
		require_once(ROOT . '/application/models/'.$className . '.php');
	} else if (file_exists(ROOT . '/system/' . $className . '.php')) {
		require_once(ROOT . '/system/' . $className . '.php');
	}
}

// Dissect the url into an array. Fall back to DEFAULT_URL if none is given.
$url = ($_GET['url'] == '/') ? DEFAULT_URL : $_GET['url'];
$args = explode('/', trim($url, '/'));

// Force "Controller" appendix, for security purpose.
$controller = ucfirst($args[0]).'Controller';

// When there's no method called, fall back to $controller::index().
if (count($args) <= 1) {
	$method = 'index';
	$args[] = 'index';
} else {
	$method = $args[1];
}

if (method_exists($controller, $method)) {
	$callback = new $controller;
	call_user_func(array($callback, $method), $args);
} else {
	die('404');
}