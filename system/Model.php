<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Model
{
	public $db = NULL;

	public function __construct()
	{
		if ($dbConfig = MVC::getConfig('db')) {
			try {
				$this->db = new Database(
					'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['database'],
					$dbConfig['username'],
					$dbConfig['password'],
					array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
				);
			} catch (Exception $e) {
				MVC::errorPage(500, 'Database error: ' . $e->getMessage());
			}

			// Unset db config for security
			MVC::unsetConfig('db');
		}
	}
}