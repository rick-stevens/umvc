<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Model
{
	public $pdo = NULL;
	
	public function __construct()
	{
		$this->pdo = Database::getInstance()->pdo;
	}
}