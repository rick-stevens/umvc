<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

// Singleton
class Database
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
		$this->_connection = @new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		
		if ($this->_connection->connect_error) {
			die('Connection error (' . $this->_connection->connect_errno . '): ' . $this->_connection->connect_error);
		} elseif ( ! $this->_connection->set_charset('utf8')) {
			die('Error setting character set: ' . $this->_connection->error);
		}
	}
	
	public function __destruct()
	{
		if ( ! $this->_connection->connect_errno) {
			$this->_connection->close();
		}
	}
	
	public function escape($sql)
	{
		return $this->_connection->real_escape_string($string);
	}
	
	public function query($sql)
	{
		return $this->_connection->query($sql);
	}
}