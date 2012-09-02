<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// Example controller
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
		$model = new HomeModel;
		$example = $model->get();
		$this->view->save('example', $example);
		
		$this->view->display('home/index.php');
	}
}