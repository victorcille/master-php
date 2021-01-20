<?php

// Esto se encarga de hacer un include de todos los controladores que se encuentren en la carpeta controllers
function controllers_autoload($classname){
	include 'controllers/' . $classname . '.php';
}

spl_autoload_register('controllers_autoload');