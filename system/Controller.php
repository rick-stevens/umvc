<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Controller
{
	public $view = NULL;
	public $smarty = NULL;
	
	public function __construct()
	{
		if (defined('SMARTY_DIR')) {
			require SMARTY_DIR . 'Smarty.class.php';
			$this->smarty = new SmartyPlugin;
		} else {
			$this->view = new View;
		}
	}
}