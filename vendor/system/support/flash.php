<?php
	
class Flash{
	
	static $current_flash = array();
	
	
	static function notice($message) {
		Session::array_set('flash', 'notice', $message);
	}

	static function error($message) {
		Session::array_set('flash', 'error', $message);
	}

	static function get($name) {
		return self::$current_flash[$name];
	}

	static function show() {
		if(self::has_flash()){
			
			if(self::has_notice_message()){
				echo "<div class='flash notice'>". self::get('notice') . "</div>";
			}else{
				echo "<div class='flash notice'>". self::get('error') . "</div>";
			}
		
			Session::destroy('flash');
			
		}
	}
	
	static function has_flash(){
		self::$current_flash	= Session::array_get('flash');

		if( empty(self::$current_flash) ){
			$flash = false;
		}else{
			$flash = true;
		}
		
		return $flash;
	}
	
	static function has_notice_message(){
		
		if (array_key_exists('notice', self::$current_flash)) {
		    $notice = true;
		}else{
			$notice = false;
		}
		
		return $notice;
	}
	
}
	
?>