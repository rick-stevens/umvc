<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// (optional) Override the locale for date formatting, etc.
#setlocale(LC_ALL, 'en_US.UTF-8');

// TRUE: display_errors, FALSE: log_errors (/system/tmp/logs/error.log)
$config['development'] = TRUE;

// (optional) Uncomment and change this to your website's URL + subfolder(s) (see /.htaccess for additional subfolder settings)
// No trailing slash!
#$config['root'] = 'http://example.com/subfolder';

// (optional) Uncomment these to enable PDO database access in models through $this->db
#$config['db']['host'] = 'localhost';
#$config['db']['database'] = '';
#$config['db']['username'] = '';
#$config['db']['password'] = '';

// Routes: $config['routes'][ $match ] = array( $replacement [, $redirect = FALSE [, $statusCode = 302 ]] )
$config['routes']['/'] = array('/example');