<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

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
		$this->view->set('query', $query);
		
		$this->view->display('home');
	}
}