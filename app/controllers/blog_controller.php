<?php

class BlogController Extends ApplicationController {

	public function index(){
		$this->posts = Posts::find_all_posts();
		$this->postx = new Posts();
		$this->flash("notice", "testing...");
		//$this->redirect_to( array("controller" => "welcome") );
		$this->render();
	}

	public function show(){
	}
	
	public function news(){
	}
	
	public function edit(){
	}
	
	public function create(){
	}
	
	public function update(){
	}
	
	public function destroy(){
	}

}

?>
