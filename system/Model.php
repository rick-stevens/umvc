<?php
  /////////////////////////
 // µMVC: git.io/PKKsQg //
/////////////////////////

class Model
{
	protected $db = NULL;

	public function __construct()
	{
		$this->db = Database::getInstance();
	}
}