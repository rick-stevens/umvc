<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

class Model
{
	protected $_db = NULL;
	
	public function __construct()
	{
		$this->_db = Database::getInstance();
	}
}