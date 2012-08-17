<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class View
{
	private static $_instance = NULL;
	private $_views = array();
	
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
			self::$_instance = new self;
		
		return self::$_instance;
	}
	
	public function fetch($_fileName, $_vars = NULL)
	{
		extract((array)$_vars);
		unset($_vars);
		
		$config = RSMVC::getConfig();
		
		ob_start();
		require ROOT . 'app/views/' . $_fileName;
		$output = ob_get_contents();
		ob_end_clean();
		
		return $output;
	}
	
	public function display($_fileName, $_vars = NULL)
	{
		$this->_views[] = $this->fetch($_fileName, $_vars);
	}
}