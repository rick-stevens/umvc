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
		if ( ! isset(self::$_instance)) {
			try {
				$dbConfig = Core::getConfig('db');
				
				self::$_instance = new PDO(
					'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['database'],
					$dbConfig['username'],
					$dbConfig['password'],
					array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
				);
			} catch (Exception $e) {
				trigger_error('Database error: ' . $e->getMessage(), E_USER_ERROR);
			}
		}
		
		return self::$_instance;
	}
}