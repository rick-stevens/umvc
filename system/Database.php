<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class Database
{
	private static $_instance = NULL;
	
	private function __construct() {}
	
	public static function getInstance()
	{
		if ( ! isset(self::$_instance) && isset(Core::$config['db'])) {
			try {
				self::$_instance = new PDO(
					'mysql:host=' . Core::$config['host'] . ';dbname=' . Core::$config['database'],
					Core::$config['username'],
					Core::$config['password'],
					array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
				);
			} catch (Exception $e) {
				trigger_error('Database error: ' . $e->getMessage(), E_USER_ERROR);
			}
			
			// Unset the database config for security.
			unset(Core::$config['db']);
		}
		
		return self::$_instance;
	}
}