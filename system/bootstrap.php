<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

require_once ROOT . 'app/configs/config.php';

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

spl_autoload_register(function ($className)
{
	$directories = array(
		ROOT . 'app/controllers/',
		ROOT . 'app/models/',
		ROOT . 'app/plugins/',
		ROOT . 'system/'
	);
	
	foreach ($directories as $dir)
		if (file_exists($dir . $className . '.php')) {
			require_once($dir . $className . '.php');
			return;
		}
});

// Handle error documents.
if (isset($_GET['error_page']) && array_key_exists((int)$_GET['error_page'], Helper::$statusCodes))
	Helper::showErrorPage((int)$_GET['error_page']);

// Handle the URL and return an associative array.
$input = Helper::setInput(@$_GET['url']);

// Call the appropriate controller and method.
if (method_exists($input['controller'], $input['method'])) {
	$controller = new $input['controller'];
	call_user_func_array(array($controller, $input['method']), $input['args']);
} else
	Helper::showErrorPage(404);