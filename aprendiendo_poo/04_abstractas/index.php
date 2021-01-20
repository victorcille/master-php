<?php

require_once './lenovo.php';

$lenovo = new Lenovo();

$lenovo->encender();  // Método abstracto definido en la clase Ordenador y desarrollado en la clase Lenovo
//$lenovo->apagar();  // Método abstracto definido en la clase Ordenador y desarrollado en la clase Lenovo
$encendido = $lenovo->getEncendido();  

$lenovo->setRam('8GB');
$ram = $lenovo->getRam();

$caracteristicas = $lenovo->getPiezas();  // Método público definido y desarrollado en la clase Ordenador

echo $caracteristicas . "<br />";

if($encendido){
    echo "Este en concreto es un Lenovo de $ram de RAM y está encendido.";
}else{
    echo "Este en concreto es un Lenovo de $ram de RAM y está apagado.";
}
//var_dump($lenovo);

