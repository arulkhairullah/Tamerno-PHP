<?php	

/**
*
* @author arul khairullah
*/

class Map {
	
	public static function get($url, $options) {
		Recorder::start($url, $options, 'GET');
	}
	
	public static function post($url, $options) {
		Recorder::start($url, $options, 'POST');
	}
	
	public static function put($url, $options) {
		Recorder::start($url, $options, 'PUT');
	}
	
	public static function delete($url, $options) {
		Recorder::start($url, $options, 'DELETE');
	}
	
	public static function ajax($url, $options) {
		Recorder::start($url, $options, 'XMLHttpRequest');
	}
	
	public static function resources($controller){
		self::get(		'/' . $controller,  				$controller . '#index');
		self::get(		'/' . $controller . '/:id/show',	$controller . '#show');
		self::get(		'/' . $controller . '/new',  		$controller . '#add');
		self::get(		'/' . $controller . '/:id/edit',	$controller . '#edit');
		self::post(		'/' . $controller,  				$controller . '#create');
		self::put(		'/' . $controller,  				$controller . '#update');
		self::delete(	'/' . $controller,  				$controller . '#destroy');
	}
	
}
	
?>