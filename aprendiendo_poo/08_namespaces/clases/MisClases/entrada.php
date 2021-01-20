<?php
// Normalmente el namespace suele ser el mismo nombre que tiene la carpeta
namespace MisClases;

class Entrada{
    public $titulo;
    public $fecha;
    
    public function __construct(){
        $this->titulo = "Post review del GTA 5";
        $this->fecha = "30 de septiembre de 2020";
    }
}
