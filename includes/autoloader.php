<?php
spl_autoload_register('myAutoLoader');

function myAutoLoader($className){
    $extension = ".class.php";
    $root = dirname(__DIR__) . "/classes/";
    $file = $root . $className . $extension;
	if (file_exists($file)) {
		require_once $file;
	}
}