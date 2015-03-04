<?php
	
class ErrorsController Extends BaseController {
	
	public function index(){
		$this->registry->view->blog_heading = 'This is the 404';
		$this->registry->view->show('error404');
	}
	
}

?>