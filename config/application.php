<?php

//error reporting is on
error_reporting(E_ALL);
ini_set('display_errors', 1);

//set default time zone
date_default_timezone_set("Asia/Jakarta");

//set security vault
define('__security_vault'	, '__ajnadj89JHLKJN*&&@*)LN)(PJILKNkj&&*&*%%KKK??+==_UHJKL@u98230jnsd');

//set session name key
define('__app_session'		, (md5(__security_vault). 'put_your_salt_here'));

//set session start here
session_start();
	
?>