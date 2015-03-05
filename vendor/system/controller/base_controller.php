<?php
	
class BaseController{
	
	
    /**
	* @set the $registry variable
    * @access private
    */
	protected $registry;
	
    /**
	* @set the $vars variable
    * @access public
    */
	public $vars = array();
	
    /**
    * @set $controller variable
    * @access public
    */
	public	$current_controller;
	
    /**
    * @set $action variable
    * @access public
    */
	public	$current_action;
	
    /**
    * @set $params variable type or array
    * @access public
    */
	public $params = array();
	
	/**
	* @set default registry
	* @params $registry
	*/
	function __construct($registry){

		$this->registry = $registry;
		
		$this->assign_controller_params();
		
		$this->load_before_filter();
	}
	
    /*
    * magic method
    * @set undefined vars
    * @param string $index
    * @param mixed $value
    * @return void
    */
	public function __set($index, $value){
		$this->vars[$index] = $value;
	}
	
    /*
    * render method
    * @return void
    */
	protected function render(){
		$this->registry->view->load_to_layout($this->vars);	
	}

	protected function redirect_to($options){
		if(is_array($options)){
			$url = $this->redirect_to_array_options($options);
		}else{
			$url = $this->redirect_to_other($options);
		}
		
		$this->redirect($url);
	}
	
	private function redirect_to_array_options($options){
		$controller	= array_key_exists('controller', $options);
		$action 	= array_key_exists('action', $options);
		$class 		= $this->params['controller'];

		if($controller AND $action){
			$url = Recorder::format_url( array("controller" => $options["controller"], "action" => $options["action"]), $options );
		}elseif($controller AND ($action == false)){
			$url = Recorder::format_url( array("controller" => $options["controller"], "action" => "index"), $options );
		}elseif(($controller == false) AND $action){
			$url = Recorder::format_url( array("controller" => $class, "action" => $options["action"]), $options );
		}
		
		return $url;
	}
	
	private function redirect_to_other($options){
		$options = String::lowercase($options);
		
		if($options == "back"){
			return $_SERVER['HTTP_REFERER'];
		}
	}
	
    /*
    * 
    * @set redirect functionality
    * @param string $url
    * @return void
    */
	protected function redirect($url){
		header("Location: /" . $this->app_dirname() . $url);
		exit;
	}
	
	public function app_dirname(){
		preg_match_all('/(([^\/]){1}(\/\/)?){1,}/', __site_path, $dir_found);
		return (end($dir_found[0]));
	}
	
	protected function flash($type, $message){
		($type == 'notice') ? Flash::notice($message) : Flash::error($message);
	}
	
	protected function before_filter($action) {		
		$this->$action();
	}
	
	//PHP 5 >= 5.1.0
	protected function load_before_filter(){
		if(property_exists($this, 'before_filter')){
			$action = $this->before_filter[0];
			$this->before_filter($action);
		}
	}
	
	private function assign_controller_params(){
		$route 			= $this->registry->route;
		$other_array 	= array_merge($route->params["get"], $route->params["post"]);

		$this->params = array(
		    "controller" => $route->controller,
			"action" => $route->action,
		);
		
		$this->params =  array_merge($this->params, $other_array);
	}
	//all controller must be have action index
	//abstract function index();
	
}
	
?>