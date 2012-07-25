<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class Helper
{
	private static $_input = NULL;
	
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
	public static function showErrorPage($errorCode, $customMessage = NULL)
	{
		$statusCodes = array(
			200	=> array('OK', ''),
			201	=> array('Created', ''),
			202	=> array('Accepted', ''),
			203	=> array('Non-Authoritative Information', ''),
			204	=> array('No Content', ''),
			205	=> array('Reset Content', ''),
			206	=> array('Partial Content', ''),
	
			300	=> array('Multiple Choices', ''),
			301	=> array('Moved Permanently', ''),
			302	=> array('Found', ''),
			304	=> array('Not Modified', ''),
			305	=> array('Use Proxy', ''),
			307	=> array('Temporary Redirect', ''),
	
			400	=> array('Bad Request', 'Something went wrong.'),
			401	=> array('Unauthorized', 'You are not authorized to view this page.'),
			403	=> array('Forbidden', 'You are not allowed to view this page.'),
			404	=> array('Not Found', 'The page you were looking for cannot be found.'),
			405	=> array('Method Not Allowed', ''),
			406	=> array('Not Acceptable', ''),
			407	=> array('Proxy Authentication Required', ''),
			408	=> array('Request Timeout', ''),
			409	=> array('Conflict', ''),
			410	=> array('Gone', ''),
			411	=> array('Length Required', ''),
			412	=> array('Precondition Failed', ''),
			413	=> array('Request Entity Too Large', ''),
			414	=> array('Request-URI Too Long', ''),
			415	=> array('Unsupported Media Type', ''),
			416	=> array('Requested Range Not Satisfiable', ''),
			417	=> array('Expectation Failed', ''),
	
			500	=> array('Internal Server Error', 'Something went wrong.'),
			501	=> array('Not Implemented', ''),
			502	=> array('Bad Gateway', ''),
			503	=> array('Service Unavailable', ''),
			504	=> array('Gateway Timeout', ''),
			505	=> array('HTTP Version Not Supported', '')
		);
	
		$errorText = $statusCodes[$errorCode][0];
		$errorDescription = isset($customMessage) ? $customMessage : $statusCodes[$errorCode][1];
		
		$input = self::getInput();
	
		header("HTTP/1.0 {$errorCode} {$errorText}", TRUE, $errorCode);
		
		require ROOT . 'app/views/error.php';
		
		exit;
	}
}