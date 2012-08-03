<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// Retrieve or change any of these values in your app with Core::$config, or through $config in your views.

// TRUE: display_errors, FALSE: log_errors.
$config['development'] = TRUE;

// Change this to your website (+ any subfolders). (See /.htaccess for additional subfolder settings.)
#$config['httpRoot'] = 'http://www.example.com/';

// Uncomment these to enable database access in models by using $this->db:
#$config['db']['host'] = 'localhost';
#$config['db']['database'] = '';
#$config['db']['username'] = '';
#$config['db']['password'] = '';

// Route format: $config['routes'][ (string) $match ] = array( (string) $replacement [, (bool) $redirect = FALSE [, (int) $statusCode = 302]] )
$config['routes'][''] = array('home/');

// Examples:
#$config['routes']['u/([0-9]+)/'] = array('users/user/$1/');
#$config['routes']['this/is/a/'] = array('permanent/redirect/', TRUE, 301);