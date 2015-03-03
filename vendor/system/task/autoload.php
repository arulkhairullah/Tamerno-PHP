<?php

// auto load model classes
function autoload_model($class_name) {
    $filename = strtolower($class_name) . '.php';
    $file = __site_path . '/app/models/' . $filename;

    if (!is_readable($file))
    {
		throw new Exception('Invalid model path: ' . $file);
        return false;
    }
	
	include ($file);
}

spl_autoload_register("autoload_model");

?>