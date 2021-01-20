<?php
// Para no tener que cargar todos los ficheros que necesitamos haciendo los requires o includes, podemos utilizar el fichero autoload que nos hemos creado
/*
require_once './clases/usuario.php';
require_once './clases/categoria.php';
require_once './clases/entrada.php';
*/

require_once __DIR__ . '/autoload.php';

$usuario = new Usuario();
$categoria = new Categoria();
$entrada = new Entrada();

echo $usuario->nombre . '<br />';
echo $categoria->nombre . '<br />';
echo $entrada->titulo . '<br />';