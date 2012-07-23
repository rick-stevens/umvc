<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

final class Database
{
	private static $_instance = NULL;
	private $_connection = NULL;
	
	public static function getInstance()
	{
		if ( ! isset(self::$_instance)) {
			self::$_instance = new Database;
		}
		
		return self::$_instance;
	}
	
	private function __construct()
	{
		try {
			$this->_connection = new PDO(
				'mysql:host=' . DB_HOST . ';dbname=' . DB_DATABASE,
				DB_USERNAME,
				DB_PASSWORD,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
			);
		} catch (Exception $e) {
			die('Database error: ' . $e->getMessage());
		}
	}
	
	public function escape($string)
	{
		return $this->_connection->quote($string);
	}
	
	// For INSERT and UPDATE queries. Returns affected rows (int).
	public function exec($sql)
	{
		return $this->_connection->exec($sql);
	}
	
	// For SELECT queries. Returns PDOStatement (object) or FALSE (bool) on failure.
	// http://www.php.net/manual/en/class.pdostatement.php
	public function query($sql)
	{
		return $this->_connection->query($sql);
	}
	
	public function insertId()
	{
		return $this->_connection->lastInsertId();
	}
}