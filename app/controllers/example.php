<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// Example controller
class Example extends Controller
{
	/*
	public function __construct()
	{
		parent::__construct();
	}
	*/
	
	public function index(/* $arg1 = NULL, $arg2 = NULL, etc. */)
	{
		$model = new ExampleModel;
		$data = $model->get();
		
		$this->view->save('example', $data);
		$this->view->display('example/index.php');
	}
}