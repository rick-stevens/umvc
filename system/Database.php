<?php
  /////////////////////////
 // umvc.googlecode.com //
/////////////////////////

class Database
{
	private static $instance = NULL;

	private function __construct() {}

	public static function getInstance()
	{
		if ( ! isset(self::$instance) && isset(MVC::$config['db'])) {
			try {
				self::$instance = new PDOWrapper(
					'mysql:host=' . MVC::$config['db']['host'] . ';dbname=' . MVC::$config['db']['database'] . ';charset=utf8',
					MVC::$config['db']['username'],
					MVC::$config['db']['password']
				);
			} catch (Exception $e) {
				MVC::errorPage(500, 'Database error: ' . $e->getMessage());
			}

			// Unset db config for security
			unset(MVC::$config['db']);
		}

		return self::$instance;
	}
}