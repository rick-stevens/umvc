<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Database extends PDO
{
	public function query($statement)
	{
		RSMVC::$queries++;
		
		$startTime = microtime(TRUE);
		$return = parent::query($statement);
		RSMVC::$queryTimer += microtime(TRUE) - $startTime;
		
		return $return;
	}
	
	public function exec($statement)
	{
		RSMVC::$queries++;
		
		$startTime = microtime(TRUE);
		$return = parent::exec($statement);
		RSMVC::$queryTimer += microtime(TRUE) - $startTime;
		
		return $return;
	}
	
	public function lastInsertId($name = NULL)
	{
		RSMVC::$queries++;
		
		$startTime = microtime(TRUE);
		$return = parent::lastInsertId($name);
		RSMVC::$queryTimer += microtime(TRUE) - $startTime;
		
		return $return;
	}
}