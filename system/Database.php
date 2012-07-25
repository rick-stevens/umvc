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
				self::$_instance = new PDO(
					'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE,
					DB_USERNAME,
					DB_PASSWORD,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
				);
			} catch (Exception $e) {
				trigger_error('Database error: ' . $e->getMessage(), E_USER_ERROR);
			}
		}
		
		return self::$_instance;
	}
}