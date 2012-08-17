<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Database extends PDO
{
	public function query($sql)
	{
		RSMVC::$queries++;
		
		$startTime = microtime(TRUE);
		$return = parent::query($sql);
		RSMVC::$queryTimer += microtime(TRUE) - $startTime;
		
		return $return;
	}
	
	public function exec($sql)
	{
		RSMVC::$queries++;
		
		$startTime = microtime(TRUE);
		$return = parent::exec($sql);
		RSMVC::$queryTimer += microtime(TRUE) - $startTime;
		
		return $return;
	}
	
	public function lastInsertId($seqname = NULL)
	{
		RSMVC::$queries++;
		
		$startTime = microtime(TRUE);
		$return = parent::lastInsertId($seqname = NULL);
		RSMVC::$queryTimer += microtime(TRUE) - $startTime;
		
		return $return;
	}
}