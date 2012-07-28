<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class View
{
	public function fetch($view, $_data = array())
	{
		extract((array)$_data);
		unset($_data);
		$input = Core::getInput();
		
		ob_start();
		require ROOT . 'app/views/' . $view . '.php';
		$_output = ob_get_contents();
		ob_end_clean();
		
		return $_output;
	}
	
	public function display($view, $_data = array())
	{
		extract((array)$_data);
		unset($_data);
		$input = Core::getInput();
		
		require ROOT . 'app/views/' . $view . '.php';
	}
}