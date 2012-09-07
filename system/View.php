<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class View
{
	private static $_instance = NULL;
	private $_views = array();
	private $_vars = array();
	
	private function __construct() {}
	
	public function __destruct()
	{
		$replacements = array(
			'[#queries#]' => RSMVC::$queries,
			'[#timer#]' => round(microtime(TRUE) - RSMVC::$timer, 4),
			'[#queryTimer#]' => round(RSMVC::$queryTimer, 4)
		);
		
		foreach ($this->_views as $view) 
			echo preg_replace(array_keys($replacements), $replacements, $view);
	}
	
	public static function getInstance()
	{
		if ( ! isset(self::$_instance))
			self::$_instance = new View;
		
		return self::$_instance;
	}
	
	public function isCached($fileName, $cacheId = NULL)
	{
		return file_exists(ROOT . 'system/tmp/cache/' . md5($fileName . $cacheId));
	}
	
	public function clearCache($fileName = NULL, $cacheId = NULL)
	{
		if ($fileName)
			@unlink(ROOT . 'system/tmp/cache/' . md5($fileName . $cacheId));
		else
			foreach (glob(ROOT . 'system/tmp/cache/*') as $file)
				@unlink($file);
	}
	
	public function save($key, $value = NULL)
	{
		if (is_array($key))
			$this->_vars = array_merge($this->_vars, $key);
		else
			$this->_vars[$key] = $value;
	}
	
	public function fetch($_fileName, $_caching = FALSE, $_cacheId = NULL)
	{
		if ($_caching && $this->isCached($_fileName, $_cacheId))
			$output = @file_get_contents(ROOT . 'system/tmp/cache/' . md5($_fileName . $_cacheId));
		else {
			extract($this->_vars);
			
			$config = RSMVC::getConfig();
			
			ob_start();
			require ROOT . 'app/views/' . $_fileName;
			$output = ob_get_contents();
			ob_end_clean();
			
			if ($_caching) {
				$handle = @fopen(ROOT . 'system/tmp/cache/' . md5($_fileName . $_cacheId), 'w') or RSMVC::errorPage(500, 'Couldn\'t write to cache folder.');
				fwrite($handle, $output);
				fclose($handle);
			}
		}
		
		return $output;
	}
	
	public function display($fileName, $caching = FALSE, $cacheId = NULL)
	{
		$this->_views[] = $this->fetch($fileName, $caching, $cacheId);
	}
}