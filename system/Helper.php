<?php
  //////////////////////////
 // rsmvc.googlecode.com //
//////////////////////////

final class Helper
{
	public static $errorCodes = array(
		400	=> 'Bad Request',
		401	=> 'Unauthorized',
		403	=> 'Forbidden',
		404	=> 'Not Found',
		#405	=> 'Method Not Allowed',
		#406	=> 'Not Acceptable',
		#407	=> 'Proxy Authentication Required',
		#408	=> 'Request Timeout',
		#409	=> 'Conflict',
		#410	=> 'Gone',
		#411	=> 'Length Required',
		#412	=> 'Precondition Failed',
		#413	=> 'Request Entity Too Large',
		#414	=> 'Request-URI Too Long',
		#415	=> 'Unsupported Media Type',
		#416	=> 'Requested Range Not Satisfiable',
		#417	=> 'Expectation Failed',

		500	=> 'Internal Server Error'
		#501	=> 'Not Implemented',
		#502	=> 'Bad Gateway',
		#503	=> 'Service Unavailable',
		#504	=> 'Gateway Timeout',
		#505	=> 'HTTP Version Not Supported'
	);
	
	private function __construct() {}
	
	// Create an instant HTTP redirect.
	public static function redirect($location, $statusCode = 302)
	{
		header('Location: ' . HTTP_ROOT . $location, TRUE, $statusCode);
		exit;
	}
	
	// Print an error page.
	public static function showErrorPage($errorCode)
	{
		$errorText = self::$errorCodes[$errorCode];
		$input = Core::getInput();
	
		header("HTTP/1.1 {$errorCode} {$errorText}", TRUE, $errorCode);
		require ROOT . 'app/views/error_page.php';
		exit;
	}
}