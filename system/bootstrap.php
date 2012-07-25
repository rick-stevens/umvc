<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

require_once ROOT . 'configs/config.php';

if (DEVELOPMENT) {
	error_reporting(E_ALL);
	ini_set('display_errors', 'On');
	ini_set('log_errors', 'Off');
} else {
	error_reporting(E_ALL);
	ini_set('display_errors', 'Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', ROOT . 'system/tmp/logs/error.log');
}

function __autoload($className)
{
	$directories = array(
		ROOT . 'app/controllers/',
		ROOT . 'app/models/',
		ROOT . 'system/',
		ROOT . 'system/plugins/'
	);
	
	foreach ($directories as $dir) {
		if (file_exists($dir . $className . '.php')) {
			require_once($dir . $className . '.php');
			return;
		}
	}
}

$input = Helper::dissectUrl(@$_GET['url']);

if (method_exists($input['controller'], $input['method'])) {
	$controller = new $input['controller'];
	call_user_func_array(array($controller, $input['method']), $input['args']);
} else {
	Helper::showErrorPage(404, 'The page you were looking for cannot be found.');
}