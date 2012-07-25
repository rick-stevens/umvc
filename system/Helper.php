<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class Helper
{
	private static $_input = NULL;
	
	public static $statusCodes = array(
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
	
	private function __construct() {}
	
	// Dissect the url into an array.
	public static function setInput($url)
	{
		$input = array();
		
		$input['url'] = strtolower($url);
		$input['real_url'] = $input['url'];
		
		// Compare routes against the URL.
		foreach ($GLOBALS['routes'] as $route) {
			// Escape slashes and force start-to-end match.
			$pattern = '/^' . str_replace('/', '\/', $route[0]) . '$/';
			
			if (preg_match($pattern, $input['url'])) {
				// Found a match. Check for a redirect.
				if (isset($route[2]) && $route[2]) {
					if (isset($route[3]))
						self::redirect($route[1], $route[3]);
					else
						self::redirect($route[1]);
				}
				
				$input['real_url'] = preg_replace($pattern, $route[1], $input['url']);
				break;
			}
		}
		
		$input['args'] = explode('/', trim($input['real_url'], '/'));
		
		// Force "controller" appendix for security.
		$input['controller'] = array_shift($input['args']) . 'controller';
		
		// When there's no method called, fall back to $controller->index().
		if (count($input['args']) < 1) {
			$input['method'] = 'index';
			$input['real_url'] .= 'index/';
		} else
			$input['method'] = array_shift($input['args']);
		
		$input['url'] = HTTP_ROOT . $input['url'];
		$input['real_url'] = HTTP_ROOT . $input['real_url'];
		
		self::$_input = $input;
		
		return self::getInput();
	}
	
	public static function getInput()
	{
		return self::$_input;
	}
	
	// Create an instant HTTP redirect.
	public static function redirect($location, $code = 302)
	{
		header('Location: ' . HTTP_ROOT . $location, TRUE, $code);
		exit;
	}
	
	// Print an error page.
	public static function showErrorPage($errorCode)
	{
		$errorText = self::$statusCodes[$errorCode];
		
		$input = self::getInput();
	
		header("HTTP/1.1 {$errorCode} {$errorText}", TRUE, $errorCode);
		
		require ROOT . 'app/views/error.php';
		
		exit;
	}
}