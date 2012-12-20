<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Database extends PDO
{
	public function query($statement)
	{
		$startTime = microtime(TRUE);
		$return = parent::query($statement);
		MVC::$stats['queryTimer'] += microtime(TRUE) - $startTime;
		MVC::$stats['queries']++;

		return $return;
	}

	public function exec($statement)
	{
		$startTime = microtime(TRUE);
		$return = parent::exec($statement);
		MVC::$stats['queryTimer'] += microtime(TRUE) - $startTime;
		MVC::$stats['queries']++;

		return $return;
	}

	public function lastInsertId($name = NULL)
	{
		$startTime = microtime(TRUE);
		$return = parent::lastInsertId($name);
		MVC::$stats['queryTimer'] += microtime(TRUE) - $startTime;
		MVC::$stats['queries']++;

		return $return;
	}
}