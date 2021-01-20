<?php

class Persona{
    private $nombre;
    private $apellidos;
    private $edad;
    private $nif;
    
    public function __construct($nombre, $apellidos, $edad, $nif){
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->edad = $edad;
        $this->nif = $nif;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }
    
    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function getEdad() {
        return $this->edad;
    }
    
    public function setEdad($edad) {
        $this->edad = $edad;
    }

    public function getNif() {
        return $this->nif;
    }

    public function setNif($nif) {
        $this->nif = $nif;
    }
    
    public function caminar(){
        return "Estoy caminando";
    }
    
    public function respirar(){
        return "Estoy respirando";
    }
    
    public function hablar(){
        return "Estoy hablando";
    }
}
