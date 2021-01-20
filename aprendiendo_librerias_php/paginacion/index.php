<?php

require_once '../vendor/autoload.php';

//  Conexion a la bbdd
$conexion = new mysqli("localhost", "root", "", "blog_master");
$conexion->query("SET NAMES 'utf8'");

//  Consulta para sacar tosos los elementos a paginar
$consulta = $conexion->query("SELECT * FROM entradas");
$total_elementos = $consulta->num_rows;
$elementos_por_pagina = 3;

//  Hacer paginación con la librería Zebra_Pagination
$pagination = new Zebra_Pagination();

//  Con el método records le decimos el número total de elmentos a paginar
$pagination->records($total_elementos);

//  Le indicamos el número de elementos por página
$pagination->records_per_page($elementos_por_pagina);

//  Montamos la query que irá sacando los resultados de cada página
$pagina = $pagination->get_page();
$desde = ($pagina - 1)*$elementos_por_pagina;
$hasta = $elementos_por_pagina;
$query = "SELECT * FROM entradas LIMIT $desde,$hasta";

$entradas = $conexion->query($query);

while($entrada = $entradas->fetch_object()){
    echo "<h1>{$entrada->id}) {$entrada->titulo}</h1>";
    echo "<h3>{$entrada->descripcion}</h3><hr />";
}

// Mirar en la carpeta vendor/stefangabos/zebra_pagination/examples que ahí vienen ejemplos de uso. El siguiente link lo he sacado de ahí
echo '<link rel="stylesheet" href="../vendor/stefangabos/zebra_pagination/public/css/zebra_pagination.css" type="text/css">';

// Con el método render() ya nos saca automáticamente los botones de la paginación (aunque hay que darle estilo con css)
$pagination->render();
