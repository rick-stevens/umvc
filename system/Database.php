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
		if ( ! isset(self::$_instance) && isset(RSMVC::$config['db'])) {
			try {
				self::$_instance = new PDO(
					'mysql:host=' . RSMVC::$config['db']['host'] . ';dbname=' . RSMVC::$config['db']['database'],
					RSMVC::$config['db']['username'],
					RSMVC::$config['db']['password'],
					array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
				);
			} catch (Exception $e) {
				trigger_error('Database error: ' . $e->getMessage(), E_USER_ERROR);
			}
			
			// Unset the database config for security.
			unset(RSMVC::$config['db']);
		}
		
		return self::$_instance;
	}
}