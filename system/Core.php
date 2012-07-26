<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class Core
{
	private static $_input = NULL;
	
	public static function autoload($className)
	{
		$directories = array(
			ROOT . 'app/controllers/',
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
	
	// Dissect the url into an array.
	public static function setInput($url, $routes)
	{
		$input = array();
		
		$input['url'] = strtolower($url);
		$input['real_url'] = $input['url'];
		
		// Compare routes against the URL.
		foreach ($routes as $route) {
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
}