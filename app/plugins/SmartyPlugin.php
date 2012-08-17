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
	}
	
	public function fetch($template = NULL, $cache_id = NULL, $compile_id = NULL, $parent = NULL, $display = FALSE, $merge_tpl_vars = TRUE, $no_output_filter = FALSE)
	{
		$this->assign('config', RSMVC::getConfig());
		
		return parent::fetch($template, $cache_id, $compile_id, $parent, $display, $merge_tpl_vars, $no_output_filter);
	}
	
	public function display($template = NULL, $cache_id = NULL, $compile_id = NULL, $parent = NULL)
	{
		$this->assign('config', RSMVC::getConfig());
		
		return parent::display($template, $cache_id, $compile_id, $parent);
	}
}