<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

// TRUE: display_errors, FALSE: log_errors.
define('DEVELOPMENT', TRUE);

// The fallback controller if none is specified.
define('DEFAULT_CONTROLLER', 'HomeController');

// For use in HTML, by default "/". Must be equal to /.htaccess' RewriteBase.
define('SITE_ROOT', '/');

// (using the MySQLi extension)
define('DB_HOST', 'localhost');
define('DB_DATABASE', 'test');
define('DB_USERNAME', 'test');
define('DB_PASSWORD', 'test');