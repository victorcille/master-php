<?php

function app_autoloader($class){
    require_once __DIR__ . "/clases/$class.php";
}

// Con esta función de php me ejecuta el método que he definido más arriba y se me cargan todas las clases que haya en la carpeta 'clases'
spl_autoload_register('app_autoloader');