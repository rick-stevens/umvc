<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class Helper
{
	private function __construct() {}
	
	// Dissect the url into an array.
	public static function dissectURL($url, $allowRedirect = TRUE)
	{
		$realUrl = $url;
		
		// Compare routes against the URL.
		foreach ($GLOBALS['routes'] as $route) {
			// Escape slashes and force start-to-end match.
			$pattern = '/^' . str_replace('/', '\/', $route[0]) . '$/';
			if (preg_match($pattern, $url)) {
				// Found a match. Check for a redirect.
				if ($allowRedirect && isset($route[2]) && $route[2]) {
					if (isset($route[3])) self::redirect($route[1], $route[3]);
					else self::redirect($route[1]);
				}
				
				$realUrl = preg_replace($pattern, $route[1], $url);
				break;
			}
		}
		
		$args = explode('/', trim($realUrl, '/'));
		
		// Force "Controller" appendix for security purpose.
		$controller = ucfirst(array_shift($args)) . 'Controller';
		
		// When there's no method called, fall back to $controller->index().
		$method = (count($args) < 1) ? 'index' : array_shift($args);
		
		return array(
			'url' => HTTP_ROOT . $url,
			'real_url' => HTTP_ROOT . $realUrl,
			'controller' => $controller,
			'method' => $method,
			'args' => $args
		);
	}
	
	// Create an instant HTTP redirect.
	public static function redirect($location, $code = 302)
	{
		header('Location: ' . HTTP_ROOT . $location, TRUE, $code);
		exit;
	}
	
	// Print an error page.
	public static function showErrorPage($errorCode, $message)
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
	
		header("HTTP/1.0 {$errorCode} {$errorText}", TRUE, $errorCode);
		
		require ROOT . 'app/views/error.php';
		
		exit;
	}
}