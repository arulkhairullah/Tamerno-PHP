<?php

/**
* function name debugger
* this function using for debugging tool
*/
if (!function_exists('debugger')){
	function debugger($var){
		echo "<b>Debugger:</b>";
		echo "<hr>";
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
		echo "<hr>";
	}
}

/**
* function name getallheaders
* this function using for getting header information
*/
if (!function_exists('getallheaders'))  {
	function getallheaders()
	{
	    if (!is_array($_SERVER)) {
	        return array();
	    }

	    $headers = array();
	    foreach ($_SERVER as $name => $value) {
	        if (substr($name, 0, 5) == 'HTTP_') {
	            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
	        }
	    }
	    return $headers;
	}
}
	
?>