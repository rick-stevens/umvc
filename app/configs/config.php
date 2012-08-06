<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

// Retrieve or change any of these values in your app with RSMVC::$config, or through $rsmvc['config'] in your views.

// TRUE: display_errors, FALSE: log_errors.
$config['development'] = TRUE;

// Uncomment and change this to your website (+ any subfolders). (See /.htaccess for additional subfolder settings.)
#$config['httpRoot'] = 'http://www.example.com/';

// Uncomment these to enable database access in models with $this->db:
#$config['db']['host'] = 'localhost';
#$config['db']['database'] = '';
#$config['db']['username'] = '';
#$config['db']['password'] = '';

// Route format:
// $config['routes'][ (string) $match ] = array( (string) $replacement [, (bool) $redirect = FALSE [, (int) $statusCode = 302]] )
// Examples:
// $config['routes']['u/([0-9]+)/'] = array('users/user/$1/');
// $config['routes']['this/is/a/'] = array('permanent/redirect/', TRUE, 301);
$config['routes'][''] = array('home/');