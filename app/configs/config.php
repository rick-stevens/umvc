<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// TRUE: display_errors, FALSE: log_errors (/system/tmp/logs/error.log).
$config['development'] = TRUE;

// (optional) Uncomment and change this to your website (+ any subfolders). (See /.htaccess for additional subfolder settings.)
#$config['root'] = 'http://www.example.com/';

// (optional) Uncomment these to enable PDO database access in models through $this->db:
#$config['db']['host'] = 'localhost';
#$config['db']['database'] = '';
#$config['db']['username'] = '';
#$config['db']['password'] = '';

// Routes: $config['routes'][ $match ] = array( $replacement [, $redirect = FALSE [, $statusCode = 302 ]] )
$config['routes']['/'] = array('/home/', TRUE);