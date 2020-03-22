<?php 

function classAutoLoader($class){

	$class = strtolower($class);
	$file = "includes/{$class}.php";

	if(is_file($file)&& !class_exists($class)){
		include $file;

	}//autoload and detect all the class in the project
}
spl_autoload_register('classAutoLoader'); // specify multiple autoload

function redirect($location){
	header("Location: ".$location);
}
?>
