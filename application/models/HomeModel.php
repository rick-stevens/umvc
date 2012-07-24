<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

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