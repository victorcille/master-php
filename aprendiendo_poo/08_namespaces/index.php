<?php

require_once __DIR__ . '/autoload.php';

// Así cargamos el namespace de la carpeta clases que a su vez ha sido cargada en el autoload.
// Importante: los namespaces van con la barra invertida (la barra normal es cuando estamos ante estructuras de carpetas, subcarpetas, etc)
use MisClases\Usuario;
use MisClases\Categoria;
use MisClases\Entrada;

class Principal{
    public $usuario;
    public $categoria;
    public $entrada;
    
    public function __construct(){
        // Si no cargamos primero el namespace con el use, esto falla porque las clases están asociadas a ese namespace. Ya no se sigue la estructura de carpetas sino la de namespaces
        $this->usuario = new Usuario();
        $this->categoria = new Categoria();
        $this->entrada = new Entrada();
    }
}

$principal = new Principal();

//echo $entrada->titulo . '<br />';
var_dump($principal);