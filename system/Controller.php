<?php
  /////////////////////////
 // umvc.googlecode.com //
/////////////////////////

class Controller
{
	public $view = NULL;

	public function __construct()
	{
		$this->view = new View;
	}
}