<?php
// Definimos la clase
class Coche{
    
    // Atributos
    public $modelo;
    public $matricula;
    public $velocidad;
    public $color;
    
    // Métodos
    public function __construct($modelo, $matricula, $velocidad, $color) {
        $this->modelo = $modelo;
        $this->matricula = $matricula;
        $this->velocidad = $velocidad;
        $this->color = $color;
    }
    
    public function getMatricula(){
        return $this->matricula;
    }
    
    public function setColor($color){
        $this->color = $color;
    }
    
    public function acelerar($velocidad){
        $this->velocidad = $this->velocidad + $velocidad;
    }
    
    public function frenar($velocidad){
        $this->velocidad = $this->velocidad - $velocidad;
    }
    
    public function getVelocidad(){
        return $this->velocidad;
    }
    
    public function mostrarInformacion($coche){
        if(is_object($coche)){
            $informacion = "<h1>Información del coche</h1>";
            $informacion .= "Modelo: " . $coche->modelo . "<br />";
            $informacion .= "Matricula: " . $coche->matricula . "<br />";
            $informacion .= "Color: " . $coche->color . "<br />";
        }else{
            $informacion = "Tu dato no es del tipo Coche";
        }
        
        return $informacion;
    }
}

