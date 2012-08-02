<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Model
{
	public $db = NULL;
	
	public function __construct()
	{
		if (Core::getConfig('db'))
			$this->db = Database::getInstance();
	}
}