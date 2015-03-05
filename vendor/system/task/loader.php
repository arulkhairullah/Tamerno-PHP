<?php

class Loader{
	
	function __construct(){

		$this->list_of_load();
	}
	
	public static function start(){
		return (new self);
	}
	
	private function list_of_load(){
		//include the application configuration
		$this->load_costumize_file('/config/application.php');
		
		//include the database configuration
		$this->load_costumize_file('/config/database.php');
		
		//include the support class
		$this->load_all_files_in_folder('/vendor/system/support');
		
		//include the registry class
		$this->load_all_files_in_folder('/vendor/system/registry');
		
		//include the route class
		$this->load_all_files_in_folder('/vendor/system/route');
		
		//include the database configuration
		$this->load_costumize_file('/config/routes.php');
		
		//include the controller class
		$this->load_all_files_in_folder('/vendor/system/controller');
		
		//include the database configuration
		$this->load_costumize_file('/app/controllers/application_controller.php');
		
		//include the model class
		$this->load_all_files_in_folder('/vendor/system/model');
		
		//include the view helper class
		$this->load_all_files_in_folder('/vendor/system/view/helper');
		
		//include the view class
		$this->load_all_files_in_folder('/vendor/system/view');
		
	}
	
	private function load_costumize_file($path){
		$file = __site_path . $path;
		include $file;
	}
	
	public function load_all_files_in_folder($folder){
		$folder = __site_path . $folder;
	    foreach (glob("{$folder}/*.php") as $filename)
	    {
	        include $filename;
	    }
	}
	
}
?>