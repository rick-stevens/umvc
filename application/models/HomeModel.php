<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

class HomeModel extends Model
{
	private $_db = NULL;
	
	public function __construct()
	{
		$this->_db = Database::getInstance();
	}
	
	public function get()
	{
		return $this->_db->query("
			SELECT *
			FROM `test`
		");
	}
}