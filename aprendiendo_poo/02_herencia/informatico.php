<?php
require_once './persona.php';

class Informatico extends Persona{
    private $lenguajes;
    
    public function __construct($nombre, $apellidos, $edad, $nif, $lenguajes){
        // De esta forma indicamos en php que herede el método del padre
        parent::__construct($nombre, $apellidos, $edad, $nif);
        
        $this->Lenguajes = $lenguajes;
    }
        
    public function programar(){
        return "Pico código";
    }
    
    public function debuggear(){
        return "Corrijo errores";
    }
}
