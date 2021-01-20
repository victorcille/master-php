<?php

require_once './informatico.php';

$persona = new Persona('Víctor', 'Cilleruelo', 30, '47515635G');
$informatico = new Informatico('Víctor', 'Cilleruelo', 30, '47515635G', 'JavaScript, PHP');

var_dump($persona);
var_dump($informatico);

echo $informatico->getNombre();  // Método de la clase persona
echo '<br />';
echo $informatico->caminar();  // Método de la clase persona
echo '<br />';
echo $informatico->debuggear();  // Método de la clase informático
