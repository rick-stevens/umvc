<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

class HomeController extends Controller
{
	private $HomeModel = NULL;
	
	public function __construct()
	{
		$this->HomeModel = new HomeModel;
	}
	
	public function index($args = NULL)
	{
		$data['args'] = $args;
		$data['query'] = $this->HomeModel->get();
		
		$this->view('home', $data);
	}
}