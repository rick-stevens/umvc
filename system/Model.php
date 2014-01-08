<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Model
{
	protected $db = NULL;

	public function __construct()
	{
		$this->db = Database::getInstance();
	}
}