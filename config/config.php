<?php
  ///////////////////////////
 // © 2012 RickStevens.nl //
///////////////////////////

// TRUE: display_errors, FALSE: log_errors.
define('DEVELOPMENT', TRUE);

// The fallback URL if no controller is specified.
define('DEFAULT_URL', '/home/');

// For use in HTML, by default "/". Must be equal to /.htaccess' RewriteBase.
define('SITE_ROOT', '/rsmvc/');

// (using MySQLi extension)
define('DB_HOST', 'localhost');
define('DB_DATABASE', 'test');
define('DB_USERNAME', 'test');
define('DB_PASSWORD', 'test');