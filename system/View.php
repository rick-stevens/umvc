<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class View
{
	private $_vars = array();
	
	public function __construct()
	{
		$this->_vars['input'] = dissectUrl($_GET['url'], FALSE);
	}
	
	public function vars($varName, $varValue = NULL)
	{
		if ($varValue === NULL) {
			return $this->_vars[$varName];
		} else {
			return ($this->_vars[$varName] = $varValue);
		}
	}
	
	public function view($view, $print = TRUE)
	{
		if (file_exists(ROOT . '/application/views/' . $view . '.php')) {
			extract($this->_vars);
			
			if ($print) {
				// Print the view.
				require ROOT . '/application/views/' . $view . '.php';
			} else {
				// Or use an output buffer to return the view.
				ob_start();
				require ROOT . '/application/views/' . $view . '.php';
				$output = ob_get_contents();
				ob_end_clean();
				
				return $output;
			}
		} else {
			die('Error: view ' . $view . ' not found');
		}
	}
}