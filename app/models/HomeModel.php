<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// Example model
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
		// Database example:
		
		/*
		$query = $this->db->query("
			SELECT *
			FROM ``
		");
		*/
		
		$query = array(
			array(
				'id' => 1,
				'name' => 'Foo'
			),
			array(
				'id' => 2,
				'name' => 'Bar'
			)
		);
		
		return $query;
	}
}