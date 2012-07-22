<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

class HomeController extends Controller
{
	/*
	public function __construct()
	{
		parent::__construct();
	}
	*/
	
	public function index()
	{
		$homeModel = new HomeModel;
		
		$query = $homeModel->get();
		$this->vars('query', $query);
		
		$this->view('home');
	}
}