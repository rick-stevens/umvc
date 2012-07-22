<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

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
		return $this->_db->query("
			SELECT *
			FROM `test`
		");
	}
}