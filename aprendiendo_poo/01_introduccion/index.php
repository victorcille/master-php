<?php
require_once './coche.php';

$coche = new Coche("Ford Focus", "2446VH", 160, "Blanco");
/*
var_dump($coche);
echo $coche->getVelocidad();
echo '<br />';
$coche->frenar(40);
echo $coche->getVelocidad();
*/
echo $coche->mostrarInformacion($coche);
// echo $coche->mostrarInformacion("Hola Mundo");

