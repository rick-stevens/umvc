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
		$exampleData = $model->get();

		$this->view->save('exampleData', $exampleData);
		$this->view->display('example/index.php');
	}
}