<?php
// Normalmente el namespace suele ser el mismo nombre que tiene la carpeta
namespace MisClases;

class Usuario{
    public $nombre;
    public $email;
    
    public function __construct(){
        $this->nombre = "Víctor Cilleruelo";
        $this->email = "cgutierrezvictor@gmail.com";
    }
}
