<?php

class Session {

	static function set($key, $value) {
		if(empty($_SESSION[__app_session])){
			$_SESSION[__app_session] = array();
		} 
		$_SESSION[__app_session][$key] = $value;
		
		return $value;
	}
	
	static function get($key) {
		return $_SESSION[__app_session][$key];
	}
	
	static function array_set($name, $key, $value) {
		if( empty($_SESSION[__app_session]) ){
			$_SESSION[__app_session] = array();
		}
		
		if( empty($_SESSION[__app_session][$name]) ){
			$_SESSION[__app_session][$name] = array();
		} 
		
		$_SESSION[__app_session][$name][$key] = $value;
		
		
		return $value;
	}
	
	static function array_get($name) {
		if( empty($_SESSION[__app_session][$name]) ){
			$_SESSION[__app_session][$name] = array();
		}
		
		return $_SESSION[__app_session][$name];
	}
	
	static function remove($name) {
		return $_SESSION[__app_session][$name] = null;
	}
	
	static function destroy($name) {
		unset($_SESSION[__app_session][$name]);
	}

}

?>