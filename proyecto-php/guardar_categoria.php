<?php

if(isset($_POST['enviar'])){
    
    // Cargamos datos de conexión a la bbdd
    require_once('./includes/conexion.php');
    
    $nombre = (isset($_POST['nombre']) && !empty($_POST['nombre'])) ? mysqli_real_escape_string($db, trim($_POST['nombre'])) : false;
    
    // array de errores
    $errores = array();
    
    // Validar los datos antes de guardarlos en la base de datos
    if(empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]/", $nombre) || !$nombre){
        $errores['nombre'] = "El nombre no es válido";
    }
    
    if(count($errores) == 0){
        
        // INSERTAMOS CATEGORÍA EN LA BASE DE DATOS
        $query = "INSERT INTO categorias VALUES (null, '$nombre');";
        $result = mysqli_query($db, $query);
    }
}

header('Location: ./crear_categoria.php');
