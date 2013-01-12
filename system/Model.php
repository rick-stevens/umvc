<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Model
{
	public $db = NULL;

	public function __construct()
	{
		if (isset(MVC::$config['db'])) {
			try {
				$this->db = new Database(
					'mysql:host=' . MVC::$config['db']['host'] . ';dbname=' . MVC::$config['db']['database'],
					MVC::$config['db']['username'],
					MVC::$config['db']['password'],
					array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
				);
			} catch (Exception $e) {
				MVC::errorPage(500, 'Database error: ' . $e->getMessage());
			}

			// Unset db config for security
			unset(MVC::$config['db']);
		}
	}
}