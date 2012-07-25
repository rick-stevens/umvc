<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class Database
{
	private static $_instance = NULL;
	public $pdo = NULL;
	
	public static function getInstance()
	{
		if ( ! isset(self::$_instance))
			self::$_instance = new Database;
		
		return self::$_instance;
	}
	
	private function __construct()
	{
		try {
			$this->pdo = new PDO(
				'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE,
				DB_USERNAME,
				DB_PASSWORD,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
			);
		} catch (Exception $e) {
			Helper::showErrorPage(500, 'Database error: ' . $e->getMessage());
		}
	}
}