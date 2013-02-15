<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


// my setting for the common site

define('PER_PAGE_ADMIN_VIEW', 5);
define('PER_PAGE_USER_VIEW', 5);

define('DASHBOARD_PAGE_USER_VIEW', 6);

define('CATEGORY_PAGE_USER_VIEW', 6);

define('SITE_URL', "webexpertitsolutions.com");

// email setting admin

define('ADMIN_EMAIL_ID', "bicalho@techsamurai.com.br");
//define('ADMIN_EMAIL_ID', "sanjaypatel2095@gmail.com");
define('SANJAY_EMAIL_ID', "sanjaypateldhar@gmail.com");
define('ADMIN_FROM_EMAIL_ID', "info@techsamurai.com.br");
define('ADMIN_FROM_NAME', "Bernardo Bicalho");




// facebook api setting  for the register/login

if($_SERVER['HTTP_HOST']=="localhost:888")
{
	define('APPID', '438650416190243');
	define('SECRET', '8e356dfdfc53fab3370aca40490ad7d8');
	$url = 'http://'.$_SERVER['HTTP_HOST'].'/client/bernardo/attakka/user';
	$log_out_url = 'http://'.$_SERVER['HTTP_HOST'].'/client/bernardo/attakka/user/index/1';
}

/*
if($_SERVER['HTTP_HOST']!="localhost:888" and $_SERVER['HTTP_HOST']!="localhost")
{
	define('APPID', '333195823455292');
	define('SECRET', '1a80004188a23f68df202ee781e647dd');
	
	//$url = 'http://'.$_SERVER['HTTP_HOST'].'/attakka/user';
	//$log_out_url = 'http://'.$_SERVER['HTTP_HOST'].'/attakka/user/index/1';
	
	//$url = 'http://webexpertitsolutions.com/attakka/user';
	//$log_out_url = 'http://webexpertitsolutions.com/attakka/user/index/1';
	//http://attakka.testebeta.com.br/attakka/
	
	$url = 'http://attakka.testebeta.com.br/attakka/user';
	$log_out_url = 'http://attakka.testebeta.com.br/attakka/user/index/1';
	
	
	
	
}*/


if($_SERVER['HTTP_HOST']!="localhost:888" and $_SERVER['HTTP_HOST']!="localhost")
{
	define('APPID', '468382833219049');
	define('SECRET', '571f146a1caed622afbe12b37dda1e5d');	
	$url = 'http://attakka.testebeta.com.br/attakka/user';
	$log_out_url = 'http://attakka.testebeta.com.br/attakka/user/index/1';
	
		

}


define('REDIRECT_URL', $url);
define('LOGOUT_URL', $log_out_url);


define('CATEGORY_CREATED_BY_ADMIN', 1);
define('CATEGORY_CREATED_BY_USER', 2);


define('BANNER_CREATED_BY_ADMIN', 1);
define('BANNER_CREATED_BY_USER', 2);

define('TOPIC_CREATED_BY_ADMIN', 1);
define('TOPIC_CREATED_BY_USER', 2);
define('TOPIC_HOME_PAGE', 2);



define('REVIEW_CREATED_BY_ADMIN', 1);
define('REVIEW_CREATED_BY_USER', 2);



// message constant
define('SEND_MESSAGE_TYPE', 1);
define('RECEIVE_MESSAGE_TYPE', 2);
define('REPLY_MESSAGE_TYPE', 3);



/* End of file constants.php */
/* Location: ./application/config/constants.php */