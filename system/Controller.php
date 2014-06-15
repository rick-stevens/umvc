<?php
  /////////////////////////
 // µMVC: git.io/PKKsQg //
/////////////////////////

class Controller
{
	public $view = NULL;

	public function __construct()
	{
		$this->view = new View;
	}
}
