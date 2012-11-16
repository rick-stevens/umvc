<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Database extends PDO
{
	public function query($statement)
	{
		MVC::$stats['queries']++;

		$startTime = microtime(TRUE);
		$return = parent::query($statement);
		MVC::$stats['queryTimer'] += microtime(TRUE) - $startTime;

		return $return;
	}

	public function exec($statement)
	{
		MVC::$stats['queries']++;

		$startTime = microtime(TRUE);
		$return = parent::exec($statement);
		MVC::$stats['queryTimer'] += microtime(TRUE) - $startTime;

		return $return;
	}

	public function lastInsertId($name = NULL)
	{
		MVC::$stats['queries']++;

		$startTime = microtime(TRUE);
		$return = parent::lastInsertId($name);
		MVC::$stats['queryTimer'] += microtime(TRUE) - $startTime;

		return $return;
	}
}