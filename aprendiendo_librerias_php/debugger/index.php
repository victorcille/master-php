<?php

require_once '../vendor/autoload.php';

//  Esta librería que vamos a usar (firephp) nos permite depurar por la consola del navegardor como en JavaScript pero con código PHP
//  Además de instalarla con composer, para poder usar la librería, hay que instalar en el navegador un plugin o extensión de google chrome
$frutas = array('Pera', 'Manzana', 'Piña', 'Plátano', 'Uva');

\FB::log($frutas);  // Con esto podemos usar la consola del navergador como cuando hacemos un console.log en javascript

\FB::log("Hola mundo desde debugger php");