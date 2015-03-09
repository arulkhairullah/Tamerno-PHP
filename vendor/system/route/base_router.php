<?php

/**
 *
 * @author arul khairullah
 */
	
class BaseRouter {
	
    /**
	* @set the registry variable
    * @access private
    */
	private	$registry;
	
    /**
	* @set the views_directory variable
    * @access private
    */
	private	$views_directory;

    /**
    * @set $controllers_directory variable
    * @access private
    */
	private	$controllers_directory;
	
    /**
    * @set $url variable
    * @access private
    */
	private $current_url;
	
    /**
    * @set $controller_file variable
    * @access public
    */
	public 	$controller_file;
	
    /**
    * @set $view_file variable
    * @access public
    */
	public 	$view_file;
	
    /**
    * @set $controller variable
    * @access public
    */
	public	$controller;
	
    /**
    * @set $action variable
    * @access public
    */
	public	$action;
	
    /**
    * @set $params variable type or array
    * @access public
    */
	public $params = array();

	
	/**
	* set start function, used for construct on static functionality
	* @access public
	* @return self object
	*/
	public static function start(){
		return (new self);
	}
	
	function __construct($registry){
		$this->registry = $registry;
		
		$this->predispatch();
	}
	
	public function load(){
		$this->dispatch();
	}
	
	private function predispatch(){
		$this->assign_url_parts();
		
		$this->checking_controllers_and_sub_views_directory();
	}
	
	private function assign_url_parts(){
		$this->current_url	= $this->get_current_url();
		$map 				= $this->load_router();
		$this->controller	= $map['controller'];
		$this->action 		= $map['action'];
		$this->params 		= $map['params'];
	}
	
	private function checking_controllers_and_sub_views_directory(){
		//check controller path
		$this->has_controllers_directory();
		$this->has_sub_views_directory();
	}
	
	/**
	* checking controllers directory and trow error message if invalid
	* @access private
	* @return void
	*/	
	private function has_controllers_directory(){
		//set controller path
		$this->controllers_directory	= __site_path . '/app/controllers';
		
		//check if $path is directory
		if( is_dir($this->controllers_directory) == false ){
			throw new Exception('Invalid controllers path: ' . $this->controllers_directory);
			return false;
		}
		
		$this->load_controller();
	}
	
	private function load_controller(){
		$this->controller_file = $this->controllers_directory . "/" . $this->controller . "_controller.php";
		
		//check existing file
		if( is_readable($this->controller_file) == false ){
			$this->controller_file	= $this->controllers_directory . '/errors_controller.php';
			$this->controller		= 'Errors';
		}
		
		//include the controller
		include $this->controller_file;
	}
	
	private function has_sub_views_directory(){
		$this->set_view_file();
	}
	
    /**
    * @set view file
    * @access public
    * @return void
    */
	private function set_view_file(){
		$this->checking_sub_views_directory();
		
		$this->view_file = $this->views_directory . "/" . $this->action . ".html";
		
		//check existing file
		if( is_readable($this->view_file) == false ){
			throw new Exception('Invalid views path: ' . $this->view_file);
			return false;
		}
		
	}
	
    /**
    * @set the views path
    * @access public
    * @return void
    */
	function checking_sub_views_directory(){
		$views_directory = __site_path . "/app/views/" . $this->controller;
		
		//check if $path is directory
		if( is_dir($views_directory) == false ){
			throw new Exception('Invalid views path: ' . $views_directory);
			return false;
		}
		
		$this->views_directory = $views_directory;
	}
	
	private function dispatch(){
		$this->run_action();
	}
	
	/**
	* @set the action
	* @access private
	* @return void
	*/	
	private function run_action(){
		//create new controller class instance
		$class 		= String::humanize($this->controller) . 'Controller';
		
		$this->has_class_name_in_controller($class);
		
		$controller	= new $class($this->registry);
		
		//check callable of action
		if( is_callable(array($controller, $this->action)) == false ){
			throw new Exception("Invalid `$this->action`  action in `$this->controller` controller ");
			return false;
		}else{
			$action = $this->action;
		}
		//run the action
		$controller->$action();

	}
	
	private function has_class_name_in_controller($class){
		if (!class_exists($class, false)) {
			throw new Exception("Invalid `$class`  controller in `$this->controller_file` ");
			return false;
		}
	}

	private function load_router(){
		return Recorder::apply($this->current_url);
	}
	
	private function get_current_url() {
		return Recorder::get_current_url();
	}
	
}	
	
?>