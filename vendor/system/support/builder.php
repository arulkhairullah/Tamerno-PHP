<?php
	
class Builder{
	
	//PHP 5.2.0
	public static function respond_to_json($tag, $content){
		header('Content-type: application/json');
		echo json_encode(array("{$tag}" => $content));
	}
	
}
	
?>