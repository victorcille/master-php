<?php

require_once '../vendor/autoload.php';

//  Es necesario definir el nombre original del archivo y el nombre con el que vamos a guardar nuestra imagen editada
$original_image = 'beric.jpg';
$custom_image = 'beric_custom.jpg';

$thumb = new PHPThumb\GD($original_image);  // Nos creamos un objeto de la clase PHPThumb (librería que usaremos para la manipulación de imágenes)
ob_clean();

//  Método para redimensionar: tenemos que especificarle los pixeles de alto y de ancho 
//  Guardará la relación original, es decir que si la foto es rectangular, aunque le pongas una dimensión cuadrada (200,200) 
//  seguirá siendo rectangular aunque más pequeña
$thumb->resize(400, 400);

//  Método para recortar: tenemos que indicarle desde qué pixel debe comenzar a recortar tanto en X como en Y así como el tamaño del recorte
/*
$startX = 50;
$startY = 50;
$cropWidth = 120;
$cropHeight = 120;
$thumb->crop($startX, $startY, $cropWidth, $cropHeight);
*/

// Una variante del anterior es este: recortar desde los laterales hasta llegar a los píxeles que yo le indique 
// A más pixeles indicados, menor recorte, es decir, más grande será la foto
$thumb->cropFromCenter(350);

//  Método para mostrar la imagen
$thumb->show();

//  Método para guardar la imagen ya editada (es necesario pasarle por parámetro el nombre con el que la queremos guardar)
$thumb->save($custom_image);