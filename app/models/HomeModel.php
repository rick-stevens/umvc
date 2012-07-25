<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// Example model.
class HomeModel extends Model
{
	/*
	public function __construct()
	{
		parent::__construct();
	}
	*/
	
	public function get()
	{
		return $this->pdo->query("
			SELECT *
			FROM `test`
		");
	}
}