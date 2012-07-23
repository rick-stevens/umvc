<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

require_once ROOT . '/config/config.php';
require_once ROOT . '/system/helper.php';

if (DEVELOPMENT) {
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	ini_set('log_errors', 'Off');
} else {
	error_reporting(E_ALL);
	ini_set('display_errors', 'Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', ROOT . '/system/tmp/logs/error.log');
}

$input = dissectUrl($_GET['url']);

if (method_exists($input['controller'], $input['method'])) {
	$controller = new $input['controller'];
	call_user_func(array($controller, $input['method']), $input['args']);
} else {
	showError(404, 'The page you were looking for cannot be found.');
}