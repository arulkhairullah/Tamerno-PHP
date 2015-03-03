<?php

//include the application configuration
#
include __site_path . '/config/'					.	'application.php';

//include the database configuration
#
include __site_path . '/config/'					.	'database.php';

//include the support class
include __site_path . '/vendor/system/support/'		.	'session.php';	

//include the flash class
include __site_path . '/vendor/system/support/'		.	'flash.php';		

//include the utility class
include __site_path . '/vendor/system/support/'		.	'utility.php';

//include the string class
include __site_path . '/vendor/system/support/'		.	'string.php';				
	
//include the registry class
include __site_path . '/vendor/system/registry/'	.	'registry.php';

//include the recorder class
include __site_path . '/vendor/system/route/' 		.	'recorder.php';

//include the base router class
include __site_path . '/vendor/system/route/' 		.	'base_router.php';

//include the map class
include __site_path . '/vendor/system/route/' 		.	'map.php';

//include the route initialize
#
include __site_path . '/config/' 					. 	'route.php';
	
//include the controller class
include __site_path . '/vendor/system/controller/'	.	'base_controller.php';
	
//include the applicaton controller class
#
include __site_path . '/app/controllers/'			.	'application_controller.php';

//include the model class
include __site_path . '/vendor/system/model/'		.	'base_model.php';

//include the view class
include __site_path . '/vendor/system/view/'		.	'base_view.php';

class Loader{
	
	public static function include_all_php(){
		$folder = __site_path . '/app/helpers';
	    foreach (glob("{$folder}/*.php") as $filename)
	    {
	        include $filename;
	    }
	}
	
}

Loader::include_all_php();

?>