<?php
  /////////////////////////
 // µMVC: git.io/PKKsQg //
/////////////////////////

// Example model
class HomeModel extends Model
{
	/*
	public function __construct()
	{
		parent::__construct();
	}
	*/

	public function example()
	{
		// Database example
		/*
		$query = $this->db->query('
			SELECT *
			FROM `example`
		');

		$result = $query->fetchAll(PDO::FETCH_ASSOC);
		*/

		// Static example
		$result = array(
			'foo' => 'bar'
		);

		return $result;
	}
}
