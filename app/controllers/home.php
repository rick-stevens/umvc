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
		// Caching example:
		
		// Only handle data if the view is not cached.
		if ( ! $this->view->isCached('home/index.php')) {
			$model = new HomeModel;
			$example = $model->get();
			$this->view->save('example', $example);
		}
		
		$this->view->display('home/index.php', TRUE);
		
		// Don't forget to call $this->view->clearCache([ $fileName = NULL ]) if you need to recompile the view.
	}
}