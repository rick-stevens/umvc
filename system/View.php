<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

class View
{
	private $_views = array();
	private $_vars = array();

	// Prints all queued views
	public function __destruct()
	{
		$replacements = array(
			'[#queries#]' => MVC::$stats['queries'],
			'[#timer#]' => round(microtime(TRUE) - MVC::$stats['timer'], 4),
			'[#queryTimer#]' => round(MVC::$stats['queryTimer'], 4)
		);

		foreach ($this->_views as $view)
			echo preg_replace(array_keys($replacements), $replacements, $view);
	}

	// Checks if a view is cached
	public function isCached($fileName, $cacheId = NULL)
	{
		return file_exists(ROOT . 'system/tmp/cache/' . md5($fileName . $cacheId));
	}

	// Clears a view's cache or the entire cache directory
	public function clearCache($fileName = NULL, $cacheId = NULL)
	{
		if ($fileName)
			@unlink(ROOT . 'system/tmp/cache/' . md5($fileName . $cacheId));
		else
			foreach (glob(ROOT . 'system/tmp/cache/*') as $file)
				@unlink($file);
	}

	// Stores view variables
	public function save($key, $value = NULL)
	{
		if (is_array($key))
			$this->_vars = array_merge($this->_vars, $key);
		else
			$this->_vars[$key] = $value;
	}

	// Returns a view
	public function fetch($_fileName, $_caching = FALSE, $_cacheId = NULL)
	{
		if ($_caching && $this->isCached($_fileName, $_cacheId)) {
			$output = @file_get_contents(ROOT . 'system/tmp/cache/' . md5($_fileName . $_cacheId));
		} else {
			extract($this->_vars);

			$config = MVC::$config;

			ob_start();
			require ROOT . 'app/views/' . $_fileName;
			$output = ob_get_contents();
			ob_end_clean();

			if ($_caching) {
				$handle = @fopen(ROOT . 'system/tmp/cache/' . md5($_fileName . $_cacheId), 'w') or MVC::errorPage(500, 'Couldn\'t write to cache folder.');
				fwrite($handle, $output);
				fclose($handle);
			}
		}

		return $output;
	}

	// Queues a view to print
	public function display($fileName, $caching = FALSE, $cacheId = NULL)
	{
		$this->_views[] = $this->fetch($fileName, $caching, $cacheId);
	}
}