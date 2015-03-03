<?php
	
//define the site path
$site_path = realpath(dirname(__FILE__));
define ('__site_path', $site_path);

//include the starting file
include 'vendor/system/task/boot.php';
	
?>