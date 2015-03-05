<?php
	
class WelcomeController Extends ApplicationController {
	
	public $before_filter = array('login_first');
	
	
	function index(){
		//$this->redirect_to( array("controller" => "blog", "id" => 2) );
		$this->render();
	}
}
	
?>