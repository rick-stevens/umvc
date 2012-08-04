<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class View
{
	public function fetch($view, $_data = array())
	{
		ob_start();
		$this->display($view, $_data);
		$_output = ob_get_contents();
		ob_end_clean();
		
		return $_output;
	}
	
	public function display($view, $_data = array())
	{
		extract((array)$_data);
		unset($_data);
		
		$rsmvc = array(
			'config' => RSMVC::$config,
			'input' => RSMVC::$input
		);
		
		require ROOT . 'app/views/' . $view . '.php';
	}
}