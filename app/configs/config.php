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
define('DB_DATABASE', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');

// Routes: array( $pattern , $replacement [, $redirect = FALSE [, $statusCode = 302]] )
$config['routes'][] = array('', 'home/');
#$config['routes'][] = array('u/([0-9]+)/', 'users/user/$1/'); // Dynamic example.