<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// Example Controller.
class Home extends Controller
{
	/*
	public function __construct()
	{
		parent::__construct();
	}
	*/
	
	public function index(/* $arg1 = NULL, $arg2 = NULL, etc. */)
	{
		$homeModel = new HomeModel;
		
		$data['query'] = $homeModel->get();
		
		$this->view->display('home', $data);
	}
}