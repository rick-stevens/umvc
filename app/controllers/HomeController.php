<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// Example Controller.
class HomeController extends Controller
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
		
		$query = $homeModel->get();
		
		$this->view->set('query', $query);
		$this->view->display('home.php');
		
		// Or with Smarty:
		#$this->view->assign('query', $query);
		#$this->view->display('home.tpl');
	}
}