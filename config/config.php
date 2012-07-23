<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

// TRUE: display_errors, FALSE: log_errors.
define('DEVELOPMENT', TRUE);

// Optionally change to http://www.example.com (+ subfolder). NO trailing slash!
define('SITE_ROOT', '');

// (using MySQL through PDO)
define('DB_HOST', 'localhost');
define('DB_DATABASE', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');

// Routes: array( $pattern , $replacement [, $redirect = FALSE [, $code = 302]] )
$GLOBALS['routes'][] = array('/', '/home/');
#$GLOBALS['routes'][] = array('/special-event/', '/events/event/29/', TRUE, 301); // Static example with permanent redirect.
#$GLOBALS['routes'][] = array('/u/([a-z0-9-]+)/', '/users/user/$1/'); // Dynamic example.