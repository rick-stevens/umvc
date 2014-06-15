<?php
  /////////////////////////
 // µMVC: git.io/PKKsQg //
/////////////////////////

class Database
{
	private static $_instance = NULL;

	private function __construct() {}

	public static function getInstance()
	{
		if ( ! isset(self::$_instance) && isset(MVC::$config['db'])) {
			try {
				self::$_instance = new PDOWrapper(
					'mysql:host=' . MVC::$config['db']['host'] . ';dbname=' . MVC::$config['db']['database'] . ';charset=utf8',
					MVC::$config['db']['username'],
					MVC::$config['db']['password']
				);
			} catch (Exception $e) {
				MVC::error(500, 'Database error: ' . $e->getMessage());
			}

			// Unset db config for security
			unset(MVC::$config['db']);
		}

		return self::$_instance;
	}
}
