<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class Core
{
	private static $_config = array();
	private static $_input = array();
	
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
				require_once $dir . $className . '.php';
				return;
			}
	}
	
	public static function setConfig($configEntry)
	{
		if (is_array($configEntry))
			self::$_config = array_merge(self::$_config, $configEntry);
	}
	
	public static function getConfig($configKey = NULL)
	{
		if (isset($configKey))
			return isset(self::$_config[$configKey]) ? self::$_config[$configKey] : NULL;
		else
			return self::$_config;
	}
	
	// Route or redirect the URL and store an associative array.
	public static function routeInput($url)
	{
		$input = array();
		
		$input['url'] = strtolower($url);
		$input['realUrl'] = $input['url'];
		
		// Compare routes against the URL.
		if (isset(self::$_config['routes']) && is_array(self::$_config['routes']))
			foreach (self::$_config['routes'] as $match => $route) {
				// Escape slashes and force start-to-end match.
				$match = '/^' . str_replace('/', '\/', $match) . '$/';
				
				if (preg_match($match, $input['url'])) {
					// Found a match. Check for a redirect.
					if (isset($route[1]) && $route[1]) {
						if (isset($route[2]))
							Helper::redirect($route[0], $route[2]);
						else
							Helper::redirect($route[0]);
					}
					
					$input['realUrl'] = preg_replace($match, $route[0], $input['url']);
					break;
				}
			}
		
		$input['args'] = explode('/', trim($input['realUrl'], '/'));
		$input['controller'] = array_shift($input['args']);
		
		// When there's no method called, fall back to $controller->index().
		if (count($input['args']) < 1) {
			$input['method'] = 'index';
			$input['realUrl'] .= 'index/';
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