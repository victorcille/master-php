<?php
// Normalmente el namespace suele ser el mismo nombre que tiene la carpeta
namespace MisClases;

class Categoria{
    public $nombre;
    public $descripcion;
    
    public function __construct(){
        $this->nombre = "Acción";
        $this->descripcion = "Categoría enfocada a las reviews de videojuegos de acción";
    }
}