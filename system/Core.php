<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class Core
{
	private static $_config = array();
	private static $_input = NULL;
	
	private function __construct() {}
	
	public static function autoload($className)
	{
		$directories = array(
			ROOT . 'app/models/',
			ROOT . 'app/plugins/',
			ROOT . 'system/'
		);
		
		foreach ($directories as $dir)
			if (file_exists($dir . $className . '.php')) {
				require_once($dir . $className . '.php');
				return;
			}
	}
	
	public static function setConfig($config)
	{
		self::$_config = array_merge(self::$_config, $config);
	}
	
	public static function getConfig($configKey)
	{
		return self::$_config[$configKey];
	}
	
	// Route or redirect the URL and store an associative array.
	public static function routeInput($url)
	{
		$input = array();
		
		$input['url'] = strtolower($url);
		$input['real_url'] = $input['url'];
		
		// Compare routes against the URL.
		foreach (self::$_config['routes'] as $route) {
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
		$input['controller'] = array_shift($input['args']);
		
		// When there's no method called, fall back to $controller->index().
		if (count($input['args']) < 1) {
			$input['method'] = 'index';
			$input['real_url'] .= 'index/';
		} else
			$input['method'] = array_shift($input['args']);
		
		self::$_input = $input;
	}
	
	// Retrieve the stored input data.
	public static function getInput()
	{
		return self::$_input;
	}
	
	// Call the appropriate controller and method, else 404.
	public static function callHook()
	{
		if (file_exists(ROOT . 'app/controllers/' . self::$_input['controller'] . '.php')) {
			require_once ROOT . 'app/controllers/' . self::$_input['controller'] . '.php';
			if (class_exists(self::$_input['controller'], FALSE) && method_exists(self::$_input['controller'], self::$_input['method'])) {
				call_user_func_array(array(new self::$_input['controller'], self::$_input['method']), self::$_input['args']);
				return;
			}
		}
		
		Helper::showErrorPage(404);
	}
}