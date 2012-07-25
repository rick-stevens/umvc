<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Controller
{
	public $view = NULL;
	
	public function __construct()
	{
		if (defined('VIEW_PLUGIN')) {
			$viewPlugin = VIEW_PLUGIN;
			$this->view = new $viewPlugin;
		} else
			$this->view = new View;
	}
}