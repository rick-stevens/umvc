<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class View
{
	private $_vars = array();
	
	public function __construct()
	{
		$this->_vars['input'] = dissectUrl($_GET['url'], FALSE);
	}
	
	public function get($varName)
	{
		return $this->_vars[$varName];
	}
	
	public function set($varName, $varValue)
	{
		return ($this->_vars[$varName] = $varValue);
	}
	
	public function fetch($view)
	{
		if (file_exists(ROOT . '/application/views/' . $view . '.php')) {
			extract($this->_vars);
			
			ob_start();
			require ROOT . '/application/views/' . $view . '.php';
			$output = ob_get_contents();
			ob_end_clean();
			
			return $output;
		} else {
			die('Error: view ' . $view . ' not found');
		}
	}
	
	public function display($view)
	{
		if (file_exists(ROOT . '/application/views/' . $view . '.php')) {
			extract($this->_vars);
			
			require ROOT . '/application/views/' . $view . '.php';
		} else {
			die('Error: view ' . $view . ' not found');
		}
	}
}