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
		$this->setCompileDir(ROOT . 'system/tmp/smarty/templates_c/');
		$this->setCacheDir(ROOT . 'system/tmp/smarty/cache/');
		$this->setConfigDir(ROOT . 'configs/');
		
		$this->addPluginsDir(ROOT . 'app/plugins/smarty/plugins/');
		
		$this->assign('input', Helper::dissectUrl(@$_GET['url'], FALSE));
	}
}