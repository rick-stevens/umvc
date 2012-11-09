<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// Example model
class ExampleModel extends Model
{
	/*
	public function __construct()
	{
		parent::__construct();
	}
	*/

	public function get()
	{
		// Database example
		/*
		$query = $this->db->query(
			'SELECT * ' .
			'FROM `example`'
		);
		*/

		// Static example
		$query = array(
			'foo' => 'bar'
		);

		return $query;
	}
}