<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class RSMVC
{
	const VERSION = '1.1.0';
	
	public static $timer = 0;
	public static $queries = 0;
	public static $queryTimer = 0;
	
	private static $_config = array();
	private static $_errorCodes = array(
		400 => 'Bad Request',
		401 => 'Unauthorized',
		403 => 'Forbidden',
		404 => 'Not Found',
		405 => 'Method Not Allowed',
		406 => 'Not Acceptable',
		407 => 'Proxy Authentication Required',
		408 => 'Request Timeout',
		409 => 'Conflict',
		410 => 'Gone',
		411 => 'Length Required',
		412 => 'Precondition Failed',
		413 => 'Request Entity Too Large',
		414 => 'Request-URI Too Long',
		415 => 'Unsupported Media Type',
		416 => 'Requested Range Not Satisfiable',
		417 => 'Expectation Failed',
		500 => 'Internal Server Error',
		501 => 'Not Implemented',
		502 => 'Bad Gateway',
		503 => 'Service Unavailable',
		504 => 'Gateway Timeout',
		505 => 'HTTP Version Not Supported'
	);
	
	// Static class, no need to create instances.
	private function __construct() {}
	
	public static function autoload($className)
	{
		// Note the missing controllers folder, these are loaded manually in self::init().
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
	
	// Returns the config or part of the config when $key is set.
	public static function getConfig($key = NULL)
	{
		if (isset($key))
			return isset(self::$_config[$key]) ? self::$_config[$key] : NULL;
		else
			return self::$_config;
	}
	
	// If $key is an array, it will array_merge itself with the existing config. Else if $value is NULL, it unsets the $key row.
	public static function setConfig($key, $value = NULL)
	{
		if (is_array($key))
			self::$_config = array_merge(self::$_config, $key);
		else
			if ($value === NULL)
				unset(self::$_config[$key]);
			else
				self::$_config[$key] = $value;
	}
	
	// Creates a local redirect.
	public static function redirect($location, $statusCode = 302)
	{
		header('Location: ' . self::$_config['root'] . $location, TRUE, $statusCode);
		exit;
	}
	
	// Prints an error page. If $message is not set, /app/views/errorPage.php will print one based on the $errorCode.
	public static function errorPage($errorCode, $message = NULL)
	{
		$errorText = self::$_errorCodes[$errorCode];
		$serverProtocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
		
		header($serverProtocol . ' ' . $errorCode . ' ' . $errorText, TRUE, $errorCode);
		
		$view = View::getInstance();
		
		$view->display('errorPage.php', array(
			'errorCode' => $errorCode,
			'errorText' => $errorText,
			'message' => $message
		));
		
		exit;
	}
	
	// Store the config, store and handle URL segments, handle routing/redirects, handle Apache error pages and call the controller.
	public static function init()
	{
		self::$timer = microtime(TRUE);
		
		// Register the autoloader.
		spl_autoload_register(array('RSMVC', 'autoload'));
		
		// Load and store the config.
		require_once ROOT . 'app/configs/config.php';
		
		if ( ! isset($config['development']))
			$config['development'] = FALSE;
		
		if ( ! isset($config['root']))
			$config['root'] = (($_SERVER['HTTPS'] == 'on' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '/';
		
		self::setConfig($config);
		
		if (self::$_config['development']) {
			error_reporting(E_ALL);
			ini_set('display_errors', 'On');
			ini_set('log_errors', 'Off');
		} else {
			error_reporting(E_ALL);
			ini_set('display_errors', 'Off');
			ini_set('log_errors', 'On');
			ini_set('error_log', ROOT . 'system/tmp/logs/error.log');
		}
		
		// Handle Apache error documents (see /.htaccess).
		if (isset($_GET['_errorPage']) && array_key_exists($_GET['_errorPage'], self::$_errorCodes))
			self::errorPage($_GET['_errorPage']);
		
		// Separate URL from query string.
		$url = explode('?', $_SERVER['REQUEST_URI'], 2);
		$url = $realUrl = $url[0];
		
		// Compare any routes to the URL.
		if (isset(self::$_config['routes']))
			foreach (self::$_config['routes'] as $match => $route) {
				// Force start-to-end match.
				$match = '!^' . $match . '$!';
				
				if (preg_match($match, $url)) {
					$realUrl = preg_replace($match, $route[0], $url);
					
					// Handle redirects.
					if (isset($route[1]) && $route[1])
						if (isset($route[2]))
							self::redirect(substr($realUrl, 1), $route[2]);
						else
							self::redirect(substr($realUrl, 1));
					
					break;
				}
			}
		
		// Manual multiple slash error (because explode doesn't separate empty segments).
		if (preg_match('!/{2}!', $realUrl))
			self::errorPage(404);
		
		// Explode the real URL into segments.
		$args = explode('/', trim($realUrl, '/'));
		$controller = array_shift($args);
		
		// When there's no method supplied, fall back to $controller->index().
		$method = count($args) ? array_shift($args) : 'index';
		
		// Call the appropriate controller and method.
		if (file_exists(ROOT . 'app/controllers/' . $controller . '.php')) {
			require_once ROOT . 'app/controllers/' . $controller . '.php';
			
			if (class_exists($controller, FALSE) && method_exists($controller, $method)) {
				call_user_func_array(array(new $controller, $method), $args);
				return;
			}
		}
		
		// No controller and/or method was found, show a 404 error page.
		self::errorPage(404);
	}
}