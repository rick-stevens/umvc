<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Model
{
	public $db = NULL;
	
	public function __construct()
	{
		$this->db = Database::getInstance();
	}
}