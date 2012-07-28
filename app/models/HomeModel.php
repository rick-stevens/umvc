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
		return $this->db->query("
			SELECT *
			FROM `test`
		");
	}
}