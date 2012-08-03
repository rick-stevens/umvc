<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

require_once '/path/to/Smarty-v.e.r/libs/Smarty.class.php';

class SmartyPlugin extends Smarty
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setTemplateDir(ROOT . 'app/views/');
		$this->setCompileDir(ROOT . 'app/plugins/smarty/templates_c/');
		$this->setCacheDir(ROOT . 'app/plugins/smarty/cache/');
		$this->setConfigDir(ROOT . 'configs/');
		
		$this->addPluginsDir(ROOT . 'app/plugins/smarty/plugins/');
		
		$this->assign('config', Core::$config);
		$this->assign('input', Core::$input);
	}
}