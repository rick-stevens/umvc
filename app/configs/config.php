<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// TRUE: display_errors, FALSE: log_errors.
define('DEVELOPMENT', TRUE);

// Optionally change to http://www.example.com/ (and/or any subfolders).
define('HTTP_ROOT', '/');

// (using MySQL through PDO by default)
define('DB_HOST', 'localhost');
define('DB_DATABASE', 'test');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');

// Routes: array( $pattern , $replacement [, $redirect = FALSE [, $code = 302]] )
$GLOBALS['routes'][] = array('', 'home/');
#$GLOBALS['routes'][] = array('u/([a-z0-9-]+)/', 'users/user/$1/'); // Dynamic example.

// Change to enable Smarty instead of the default View class.
#define('VIEW_PLUGIN', 'SmartyPlugin');
#define('SMARTY_DIR', '/usr/local/lib/Smarty-v.e.r/libs/');