<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class View
{
	private $_vars = array();
	
	public function __construct()
	{
		$this->_vars['input'] = Helper::dissectUrl(@$_GET['url'], FALSE);
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
		if (file_exists(ROOT . 'application/views/' . $view)) {
			extract($this->_vars);
			
			ob_start();
			require ROOT . 'application/views/' . $view;
			$output = ob_get_contents();
			ob_end_clean();
			
			return $output;
		} else {
			Helper::showErrorPage(500, 'View ' . $view . ' cannot be found.');
		}
	}
	
	public function display($view)
	{
		if (file_exists(ROOT . 'application/views/' . $view)) {
			extract($this->_vars);
			
			require ROOT . 'application/views/' . $view;
		} else {
			Helper::showErrorPage(500, 'View ' . $view . ' cannot be found.');
		}
	}
}