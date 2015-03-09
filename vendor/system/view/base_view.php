<?php
	
class BaseView{
	
	
    /**
	* @set the registry variable
    * @access private
    */
	private	$registry;
	
    /**
	* @set the layout_file variable
    * @access private
    */
	private	$layout_file;
	
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
    * @set $layout variable
    * @access public
	* @default = 'application'
    */
	public	$layout;
	
    /**
	* @set the vars variable
    * @access public
    */
	public	$vars = array();
	
	
    /**
	* @set the controller_vars variable
    * @access public
    */
	public $controller_vars = array();

	public $helpers = array();
	
    /**
	* @set the construct
    * @access public
	* @param $registry
    */
	function __construct($registry){
		$this->registry = $registry;
		$this->include_view_helpers();
		$this->assign_the_view_attributes($registry);
	}
	
    /**
	* Auto insert helper file by observe the controller name
	* If existing file, the will be load
    * @access public
	* @return void
    */
	public function auto_insert_helper_file(){
		$file = __site_path . '/app/helpers/' . $this->controller . '_helper.php';

		if(file_exists($file)){
			include $file;
						
			$class = String::humanize($this->controller) . 'Helper';
			$this->add_helper_methods($class);
		}
	}
	
    /**
	* @set the magic method functionality
	* Used for automate the set functionality added
    * @access public
	* @return void
    */
	public function __set($index, $value){
		$this->vars[$index] = $value;
	}
	
    /**
	* @set the magic method functionality
	* Used for automate the caller functionality added
    * @access public
	* @return void
    */
	public function __call($method, $args) {
		foreach($this->helpers as $ext){
			if (method_exists($ext, $method)) {
			    $reflection = new ReflectionMethod($ext, $method);
			    if (!$reflection->isPublic()) {
			        throw new Exception("Call to not public method ".get_class($this)."::$method()");
			    }

			    return call_user_func_array(array($ext, $method), $args);
			}else{
				throw new Exception("Not found the method ");
			} 
		}
	}
	
    /**
	* @set the load to layout functionality
	* Used for load the controller variables
    * @access public
	* @return void
    */
	public function load_to_layout($controller_vars){
		$this->set_layout_file();
		$this->controller_vars = $controller_vars;
		$this->load_main_layout_file();
	}
	
    /**
	* @set the assign view attributes
	* use for assignment for attributes
    * @access private
	* @param $registry
	* @return void
    */
	private function assign_the_view_attributes($registry){
		$this->controller	= $this->registry->route->controller;
		$this->action		= $this->registry->route->action;
	}
	
    /**
	* @set the include view helpers
	* use for includes the helpers method in the view file
    * @access private
	* @return void
    */
	private function include_view_helpers(){
		$this->load_application_helper_file();
		$this->auto_insert_helper_file();
	}
	
    /**
	* @set the add helper methods
	* use for the adding new helper
    * @access private
	* @param $class
	* @return void
    */
	private function add_helper_methods($class){
		$this->helpers[] = new $class;
	}
	
    /**
	* @set the add helper functionality
	* Used for adding helper, will use in the view file
    * @access private
	* @return void
    */
	private function add_helper(){
		$class_methods = get_class_methods('WelcomeHelper');

		foreach ($class_methods as $method_name) {
			$this->helpers[] = $method_name;
		    
		}
	}
	
    /**
	* @set the show page functionality
	* Used for include the file view, in the dinamic content
    * @access private
	* @return void
    */
	private function show_page(){
		foreach ( $this->controller_vars as $key => $value ){
			$$key = $value;
		}
		
		include $this->registry->route->view_file;
	}
	
    /**
	* @set the load main layout file functionality
	* Used for include the layout file in the view
    * @access private
	* @return void
    */
	private function load_main_layout_file(){
		include $this->layout_file;
	}
	
    /**
	* @set the layout file functionality
	* Used for setting the layout file path
    * @access private
	* @return void
    */
	private function set_layout_file(){
		$this->layout_file = __site_path . "/app/views/layout/{$this->layout}.html";
		$this->exist_layout_file();
	}
	
    /**
	* @set the exist the layout functionality
	* Used for checking layout file
    * @access private
	* @return void
    */
	private function exist_layout_file(){
		if( file_exists($this->layout_file ) == false ){
			throw new Exception('File layout not found in '. $this->layout_file );
			return false;
		}
	}
	
    /**
	* @set the load application helper file functionality
	* Used for load the application helper file 
    * @access private
	* @return void
    */
	private function load_application_helper_file(){
		$file = __site_path . "/app/helpers/application_helper.php";
		
		if(file_exists($file)){
			include $file;
			
			$class = new ApplicationHelper;
			$this->add_helper_methods($class);
		}else{
			throw new Exception('File Application helper not found in '. $file );
			return false;
		}
	}
	
    /**
	* @set the show flash functionality
	* Used in view for display flash message from controller 
    * @access private
	* @return text of messages
    */
	private function show_flash(){
		Flash::show();
	}
	
}


?>