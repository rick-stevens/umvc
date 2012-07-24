<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class SmartyPlugin extends Smarty
{
	public function __construct()
	{
		parent::__construct;
		
		$this->setTemplateDir(ROOT . 'application/views/');
		$this->setCompileDir(ROOT . 'system/tmp/smarty/templates_c/');
		$this->setCacheDir(ROOT . 'system/tmp/smarty/cache/');
		$this->setConfigDir(ROOT . 'configs/');
		
		$this->addPluginsDir(ROOT . 'system/plugins/smarty/plugins/');
		
		$this->assign('input', dissectUrl(@$_GET['url'], FALSE));
	}
}