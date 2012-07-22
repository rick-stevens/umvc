<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

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

// Dissect the url into an array.
function dissectURL($url)
{
	// Fall back to DEFAULT_CONTROLLER if none is given.
	$default_url = '/' . strtolower(preg_replace('/Controller/', '', DEFAULT_CONTROLLER, 1)) . '/';
	$url = ($url == '/') ? $default_url : $url;
	$args = explode('/', trim($url, '/'));
	
	// Force "Controller" appendix for security purpose.
	$controller = ucfirst(array_shift($args)) . 'Controller';
	
	// When there's no method given, fall back to $controller->index().
	$method = (count($args) < 1) ? 'index' : array_shift($args);
	
	if (empty($args)) $args = NULL;
	
	return array(
		'controller' => $controller,
		'method' => $method,
		'args' => $args
	);
}

// Print an error page.
function showError($errorCode)
{
	$errorCodes = array(
		200	=> 'OK',
		201	=> 'Created',
		202	=> 'Accepted',
		203	=> 'Non-Authoritative Information',
		204	=> 'No Content',
		205	=> 'Reset Content',
		206	=> 'Partial Content',

		300	=> 'Multiple Choices',
		301	=> 'Moved Permanently',
		302	=> 'Found',
		304	=> 'Not Modified',
		305	=> 'Use Proxy',
		307	=> 'Temporary Redirect',

		400	=> 'Bad Request',
		401	=> 'Unauthorized',
		403	=> 'Forbidden',
		404	=> 'Not Found',
		405	=> 'Method Not Allowed',
		406	=> 'Not Acceptable',
		407	=> 'Proxy Authentication Required',
		408	=> 'Request Timeout',
		409	=> 'Conflict',
		410	=> 'Gone',
		411	=> 'Length Required',
		412	=> 'Precondition Failed',
		413	=> 'Request Entity Too Large',
		414	=> 'Request-URI Too Long',
		415	=> 'Unsupported Media Type',
		416	=> 'Requested Range Not Satisfiable',
		417	=> 'Expectation Failed',

		500	=> 'Internal Server Error',
		501	=> 'Not Implemented',
		502	=> 'Bad Gateway',
		503	=> 'Service Unavailable',
		504	=> 'Gateway Timeout',
		505	=> 'HTTP Version Not Supported'
	);

	$errorText = $errorCodes[$errorCode];

	header("HTTP/1.1 {$errorCode} {$errorText}", TRUE, $errorCode);
	
	require ROOT . '/application/views/error.php';
	
	exit;
}