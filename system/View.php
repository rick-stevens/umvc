<?php
  /////////////////////////
 // µMVC: git.io/PKKsQg //
/////////////////////////

class View
{
  private $_views = array();
  private $_vars = array();

  // Prints all queued views
  public function __destruct()
  {
    $replacements = array(
      '[#version#]' => MVC::VERSION,
      '[#mode#]' => MVC::$stats['mode'],
      '[#queries#]' => MVC::$stats['queries'],
      '[#timer#]' => round((microtime(TRUE) - MVC::$stats['timer']) * 1000),
      '[#query_timer#]' => round(MVC::$stats['query_timer'] * 1000)
    );

    foreach ($this->_views as $view)
      echo preg_replace(array_keys($replacements), $replacements, $view);
  }

  // Checks if a view is cached
  public function isCached($file_name, $cache_id = NULL)
  {
    return file_exists(ROOT . 'system/tmp/cache/' . md5($file_name . $cache_id));
  }

  // Clears a view's cache or the entire cache directory
  public function clearCache($file_name = NULL, $cache_id = NULL)
  {
    if ($file_name)
      @unlink(ROOT . 'system/tmp/cache/' . md5($file_name . $cache_id));
    else
      foreach (glob(ROOT . 'system/tmp/cache/*') as $file)
        @unlink($file);
  }

  // Stores view variables
  public function save($key, $value = NULL)
  {
    if (is_array($key))
      return $this->_vars = array_merge($this->_vars, $key);
    else
      return $this->_vars[$key] = $value;
  }

  // Returns a view
  public function fetch($_file_name, $_caching = FALSE, $_cache_id = NULL)
  {
    if ($_caching && MVC::$stats['mode'] != 'development' && $this->isCached($_file_name, $_cache_id)) {
      $output = @file_get_contents(ROOT . 'system/tmp/cache/' . md5($_file_name . $_cache_id));
    } else {
      extract($this->_vars);

      $config = MVC::$config;

      ob_start();
      require ROOT . 'app/views/' . $_file_name;
      $output = ob_get_contents();
      ob_end_clean();

      if ($_caching) {
        $handle = @fopen(ROOT . 'system/tmp/cache/' . md5($_file_name . $_cache_id), 'w') or MVC::error(500, 'Couldn\'t write to cache folder.');
        fwrite($handle, $output);
        fclose($handle);
      }
    }

    return $output;
  }

  // Queues a view to print
  public function display($file_name, $caching = FALSE, $cache_id = NULL)
  {
    $this->_views[] = $this->fetch($file_name, $caching, $cache_id);
  }
}
