<?php

require_once './ordenador.php';

// Para que una clase herede de otra abstracta se usa el extends y obligatoriamente debe desarrollar los métodos que se hayan definido en el padre (en este caso encender() y apagar())
class Lenovo extends Ordenador{
    // ATRIBUTOS
    private $ram;
    private $encendido;
    
    public function getRam(){
        return $this->ram;
    }
    
    public function setRam($ram){
        $this->ram = $ram;
    }
    
    public function getEncendido(){
        return $this->encendido;
    }
    
    // Desarrollamos los métodos abstractos definidos en la clase padre
    public function encender() {
        $this->encendido = true;
    }
    
    public function apagar() {
        $this->encendido = false;
    }
}

