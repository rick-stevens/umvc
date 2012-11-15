<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class Database extends PDO
{
	public function query($statement)
	{
		MVC::$queries++;

		$startTime = microtime(TRUE);
		$return = parent::query($statement);
		MVC::$queryTimer += microtime(TRUE) - $startTime;

		return $return;
	}

	public function exec($statement)
	{
		MVC::$queries++;

		$startTime = microtime(TRUE);
		$return = parent::exec($statement);
		MVC::$queryTimer += microtime(TRUE) - $startTime;

		return $return;
	}

	public function lastInsertId($name = NULL)
	{
		MVC::$queries++;

		$startTime = microtime(TRUE);
		$return = parent::lastInsertId($name);
		MVC::$queryTimer += microtime(TRUE) - $startTime;

		return $return;
	}
}