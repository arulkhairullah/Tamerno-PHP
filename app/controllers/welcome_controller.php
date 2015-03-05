<?php
	
class WelcomeController Extends ApplicationController {
	
	function index(){
		//$this->redirect_to( array("controller" => "blog", "id" => 2) );
		$this->render();
	}
}
	
?>