<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class MVC
{
	const VERSION = 'rsmvc-1.2.5';

	public static $config = array();
	public static $stats = array(
		'timer' => 0,
		'queries' => 0,
		'queryTimer' => 0
	);

	private static $_errorCodes = array(
		400 => 'Bad Request',
		401 => 'Unauthorized',
		403 => 'Forbidden',
		404 => 'Not Found',
		500 => 'Internal Server Error'
	);

	// Static class, no need to create instances
	private function __construct() {}

	public static function autoload($className)
	{
		// Note the missing controllers folder, these are loaded manually in self::init()
		$directories = array(
			ROOT . 'app/models/',
			ROOT . 'system/'
		);

		foreach ($directories as $dir)
			if (file_exists($dir . $className . '.php')) {
				require_once $dir . $className . '.php';
				return;
			}
	}

	// Creates a local redirect
	public static function redirect($location, $statusCode = 302)
	{
		header('Location: ' . self::$config['root'] . $location, TRUE, $statusCode);
		exit;
	}

	// Prints an error page
	// If $errorMessage is not set, /app/views/errorPage.php will print one based on the $errorCode
	public static function errorPage($errorCode, $errorMessage = NULL)
	{
		$errorDescription = self::$_errorCodes[$errorCode];
		$serverProtocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';

		header($serverProtocol . ' ' . $errorCode . ' ' . $errorDescription, TRUE, $errorCode);

		$view = new View;

		$view->save('error', array(
			'code' => $errorCode,
			'description' => $errorDescription,
			'message' => $errorMessage
		));

		$view->display('errorPage.php');

		exit;
	}

	// Store the config, store and handle URL segments, handle routing/redirects, handle Apache error pages and call the controller
	public static function init()
	{
		self::$stats['timer'] = microtime(TRUE);

		// Register the autoloader
		spl_autoload_register(array(get_class(), 'autoload'));

		// Load and store the config
		require_once ROOT . 'app/configs/config.php';
		self::$config = $config;

		if (self::$config['development']) {
			error_reporting(E_ALL);
			ini_set('display_errors', 'on');
			ini_set('log_errors', 'off');
		} else {
			error_reporting(E_ALL);
			ini_set('display_errors', 'off');
			ini_set('log_errors', 'on');
			ini_set('error_log', ROOT . 'system/tmp/logs/error.log');
		}

		// Handle Apache error documents (see /.htaccess)
		if (isset($_GET['_errorPage']) && array_key_exists($_GET['_errorPage'], self::$_errorCodes))
			self::errorPage($_GET['_errorPage']);

		// Separate URL from query string
		$url = explode('?', $_SERVER['REQUEST_URI'], 2);
		$url = $routedUrl = strtolower($url[0]);

		// Compare any routes to the URL
		if (isset(self::$config['routes']))
			foreach (self::$config['routes'] as $match => $route) {
				if (preg_match($match, $url)) {
					$routedUrl = preg_replace($match, $route[0], $url);

					// Handle redirects
					if (isset($route[1]) && $route[1])
						if (isset($route[2]))
							self::redirect($routedUrl, $route[2]);
						else
							self::redirect($routedUrl);

					break;
				}
			}

		// Manual multiple slash error (because explode() doesn't separate empty segments)
		if (strpos($routedUrl, '//') !== FALSE)
			self::errorPage(404);

		// Explode the real URL into segments
		$args = explode('/', trim($routedUrl, '/'));
		$controller = array_shift($args);

		// When there's no method supplied, fall back to the $controller->index() method
		$method = count($args) ? array_shift($args) : 'index';

		// Call the appropriate controller and method
		if (file_exists(ROOT . 'app/controllers/' . $controller . '.php')) {
			require_once ROOT . 'app/controllers/' . $controller . '.php';

			if (class_exists($controller, FALSE) && method_exists($controller, $method)) {
				call_user_func_array(array(new $controller, $method), $args);
				return;
			}
		}

		// No controller and/or method was found; throw a 404
		self::errorPage(404);
	}
}