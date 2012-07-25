<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class View
{
	private $_vars = array();
	
	public function __construct()
	{
		$this->_vars['input'] = Helper::getInput();
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
		extract($this->_vars);
		
		ob_start();
		require ROOT . 'app/views/' . $view;
		$output = ob_get_contents();
		ob_end_clean();
		
		return $output;
	}
	
	public function display($view)
	{
		extract($this->_vars);
		
		require ROOT . 'app/views/' . $view;
	}
}