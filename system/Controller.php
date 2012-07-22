<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

abstract class Controller
{
	protected function view($view, $data = array())
	{
		if (file_exists(ROOT.'/application/views/' . $view . '.php')) {
			include ROOT.'/application/views/' . $view . '.php';
		} else {
			die('Error: view ' . $view . ' not found');
		}
	}
}