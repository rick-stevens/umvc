<?php
  /////////////////////////
 // µMVC: git.io/PKKsQg //
/////////////////////////

final class MVC
{
	const VERSION = 'v1.0.5';

	public static $config = array();
	public static $stats = array(
		'mode' => NULL,
		'timer' => 0,
		'queries' => 0,
		'query_timer' => 0
	);

	private static $_error_codes = array(
		400 => 'Bad Request',
		401 => 'Unauthorized',
		403 => 'Forbidden',
		404 => 'Not Found',
		500 => 'Internal Server Error'
	);

	// Static class, no need to create instances
	private function __construct() {}

	public static function autoload($class_name)
	{
		// Note the missing controllers folder, these are loaded manually in self::init()
		$directories = array(
			ROOT . 'app/models/',
			ROOT . 'system/'
		);

		foreach ($directories as $dir)
			if (file_exists($dir . $class_name . '.php')) {
				require_once $dir . $class_name . '.php';
				return;
			}
	}

	// Creates a local redirect
	public static function redirect($location, $status_code = 302)
	{
		header('Location: //' . self::$config['root'] . $location, TRUE, $status_code);
		exit;
	}

	// Recursively trims and replaces multiple whitespace characters with a single space
	public static function strip($input)
	{
		if (is_array($input)) {
			foreach ($input as $k => $v)
				$input[$k] = self::strip($v);

			return $input;
		} else {
			return trim(preg_replace('#\s+#', ' ', $input));
		}
	}

	// Prints an error page
	// If $error_message is not set, /app/views/error.php will try print one based on the $error_code
	public static function error($error_code, $error_message = NULL)
	{
		$error_description = self::$_error_codes[$error_code];
		$server_protocol = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';

		header($server_protocol . ' ' . $error_code . ' ' . $error_description, TRUE, $error_code);

		$view = new View;

		$view->save('error', array(
			'code' => $error_code,
			'description' => $error_description,
			'message' => $error_message
		));

		$view->display('error.php');

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

		// Check if HTTP_HOST matches a development host to disable log_errors and enable display_errors
		if (isset(self::$config['development_hosts']) && in_array($_SERVER['HTTP_HOST'], self::$config['development_hosts'])) {
			self::$stats['mode'] = 'development';
			error_reporting(E_ALL);
			ini_set('display_errors', 'on');
			ini_set('log_errors', 'off');
		} else {
			self::$stats['mode'] = 'production';
			error_reporting(E_ALL);
			ini_set('display_errors', 'off');
			ini_set('log_errors', 'on');
			ini_set('error_log', ROOT . 'system/tmp/logs/error.log');
		}

		// Handle Apache error documents (see /.htaccess)
		if (isset($_GET['_error']) && array_key_exists($_GET['_error'], self::$_error_codes))
			self::error($_GET['_error']);

		// Separate URL from query string
		$url = explode('?', $_SERVER['REQUEST_URI'], 2);
		$url = $routed_url = strtolower($url[0]);

		// Compare any routes to the URL
		if (isset(self::$config['routes']))
			foreach (self::$config['routes'] as $match => $route)
				if (preg_match($match, $url)) {
					$routed_url = preg_replace($match, $route[0], $url);

					// Handle redirects
					if (isset($route[1]) && $route[1])
						if (isset($route[2]))
							self::redirect($routed_url, $route[2]);
						else
							self::redirect($routed_url);

					break;
				}

		// Manual multiple slash error (because explode() doesn't separate empty segments)
		if (strpos($routed_url, '//') !== FALSE)
			self::error(404);

		// Explode the actual URL into segments
		$args = explode('/', trim($routed_url, '/'));
		$controller = array_shift($args);

		// When there's no method supplied, fall back to the $controller->index() method
		$method = count($args) ? array_shift($args) : 'index';

		// Call the appropriate controller and method
		if (file_exists(ROOT . 'app/controllers/' . $controller . '.php')) {
			require_once ROOT . 'app/controllers/' . $controller . '.php';

			if (class_exists($controller, FALSE) && method_exists($controller, $method)) {
				$reflector = new ReflectionClass($controller);

				// Throw a 404 if there are uncaught parameters
				if (count($args) > $reflector->getMethod($method)->getNumberOfParameters())
					self::error(404);

				call_user_func_array(array(new $controller, $method), $args);
				return;
			}
		}

		// No controller and/or method was found; throw a 404
		self::error(404);
	}
}
