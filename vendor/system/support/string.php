<?php
	
	
class String{
	
	public static function humanize($string) {
		return ucwords(str_replace("_", " ", $string));
	}
	
	public static function lowercase($string) {
		return strtolower(str_replace("_", " ", $string));
	}
}
	
?>