<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class RSMVC
{
	const VERSION = '1.0.0';
	public static $config, $input = array();
	public static $errorCodes = array(
		400 => 'Bad Request',
		401 => 'Unauthorized',
		403 => 'Forbidden',
		404 => 'Not Found',
		#405 => 'Method Not Allowed',
		#406 => 'Not Acceptable',
		#407 => 'Proxy Authentication Required',
		#408 => 'Request Timeout',
		#409 => 'Conflict',
		#410 => 'Gone',
		#411 => 'Length Required',
		#412 => 'Precondition Failed',
		#413 => 'Request Entity Too Large',
		#414 => 'Request-URI Too Long',
		#415 => 'Unsupported Media Type',
		#416 => 'Requested Range Not Satisfiable',
		#417 => 'Expectation Failed',

		500 => 'Internal Server Error'
		#501 => 'Not Implemented',
		#502 => 'Bad Gateway',
		#503 => 'Service Unavailable',
		#504 => 'Gateway Timeout',
		#505 => 'HTTP Version Not Supported'
	);
	
	private function __construct() {}
	
	public static function autoload($className)
	{
		// Note the missing controllers folder, this is handled separately in self::init().
		$directories = array(
			ROOT . 'app/models/',
			ROOT . 'app/plugins/',
			ROOT . 'system/'
		);
		
		foreach ($directories as $dir)
			if (file_exists($dir . $className . '.php')) {
				require_once $dir . $className . '.php';
				return;
			}
	}
	
	// Dissect and store the URL segments, handle routing/redirects, handle error page or call the controller.
	public static function init()
	{
		$input['url'] = isset($_GET['_url']) ? strtolower($_GET['_url']) : '';
		$input['realUrl'] = $input['url'];
		
		// Compare routes against the URL.
		if (isset(self::$config['routes']))
			foreach (self::$config['routes'] as $match => $route) {
				// Escape slashes and force start-to-end match.
				$match = '/^' . str_replace('/', '\/', $match) . '$/';
				
				if (preg_match($match, $input['url'])) {
					// Found a match. Check for a redirect.
					if (isset($route[1]) && $route[1]) {
						if (isset($route[2]))
							self::redirect($route[0], $route[2]);
						else
							self::redirect($route[0]);
					}
					
					$input['realUrl'] = preg_replace($match, $route[0], $input['url']);
					break;
				}
			}
		
		$input['args'] = explode('/', trim($input['realUrl'], '/'));
		$input['controller'] = array_shift($input['args']);
		
		// When there's no method called, fall back to $controller->index().
		if (count($input['args']) == 0) {
			$input['method'] = 'index';
			$input['realUrl'] .= 'index/';
		} else
			$input['method'] = array_shift($input['args']);
		
		// Store the input.
		self::$input = $input;
		
		// Handle Apache's error documents.
		if (isset($_GET['_errorPage']) && array_key_exists($_GET['_errorPage'], self::$errorCodes))
			self::showErrorPage($_GET['_errorPage']);
		
		// Call the appropriate controller and method, else 404.
		if (file_exists(ROOT . 'app/controllers/' . $input['controller'] . '.php')) {
			require_once ROOT . 'app/controllers/' . $input['controller'] . '.php';
			if (class_exists($input['controller'], FALSE) && method_exists($input['controller'], $input['method'])) {
				call_user_func_array(array(new $input['controller'], $input['method']), $input['args']);
				return;
			}
		}
		
		self::showErrorPage(404);
	}
	
	// Create an instant HTTP redirect.
	public static function redirect($location, $statusCode = 302)
	{
		header('Location: ' . self::$config['httpRoot'] . $location, TRUE, $statusCode);
		exit;
	}
	
	// Print an error page.
	public static function showErrorPage($errorCode)
	{
		$errorText = self::$errorCodes[$errorCode];
	
		$serverProtocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
		
		header($serverProtocol . ' ' . $errorCode . ' ' . $errorText, TRUE, $errorCode);
		
		$view = new View;
		
		$data['errorCode'] = $errorCode;
		$data['errorText'] = $errorText;
		$view->display('error_page', $data);
		
		exit;
	}
}