<?php
  /////////////////////////
 // µMVC: git.io/PKKsQg //
/////////////////////////

class PDOWrapper extends PDO
{
	public function query($statement)
	{
		$start_time = microtime(TRUE);
		$return = parent::query($statement);
		MVC::$stats['query_timer'] += microtime(TRUE) - $start_time;
		MVC::$stats['queries']++;

		return $return;
	}

	public function exec($statement)
	{
		$start_time = microtime(TRUE);
		$return = parent::exec($statement);
		MVC::$stats['query_timer'] += microtime(TRUE) - $start_time;
		MVC::$stats['queries']++;

		return $return;
	}

	public function lastInsertId($name = NULL)
	{
		$start_time = microtime(TRUE);
		$return = parent::lastInsertId($name);
		MVC::$stats['query_timer'] += microtime(TRUE) - $start_time;
		MVC::$stats['queries']++;

		return $return;
	}
}
