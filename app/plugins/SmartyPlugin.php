<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

require_once SMARTY_DIR . 'Smarty.class.php';

class SmartyPlugin extends Smarty
{
	public function __construct()
	{
		parent::__construct;
		
		$this->setTemplateDir(ROOT . 'app/views/');
		$this->setCompileDir(ROOT . 'app/plugins/smarty/templates_c/');
		$this->setCacheDir(ROOT . 'app/plugins/smarty/smarty/cache/');
		$this->setConfigDir(ROOT . 'configs/');
		
		$this->addPluginsDir(ROOT . 'app/plugins/smarty/plugins/');
		
		$this->assign('input', Helper::dissectUrl(@$_GET['url'], FALSE));
	}
}