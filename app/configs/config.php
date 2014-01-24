<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// (optional) Override the locale for date formatting, etc.
#setlocale(LC_ALL, 'en_US.UTF-8');

// TRUE: display_errors, FALSE: log_errors (/system/tmp/logs/error.log)
$config['development'] = TRUE;

// Example: 'example.com' (NO trailing slash!)
$config['root'] = $_SERVER['HTTP_HOST'];

// (optional) Uncomment these to enable database access in models through $this->db (PDO)
#$config['db']['host'] = 'localhost';
#$config['db']['database'] = '';
#$config['db']['username'] = '';
#$config['db']['password'] = '';

// Routes (REQUEST_URI): $config['routes'][ $match (regex) ] = array( $replacement (regex) [, $redirect = FALSE [, $status_code = 302 ]] )
$config['routes']['#^/$#'] = array('/home');