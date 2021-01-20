<?php

function mostrarError($errores, $campo){
    $alerta = '';
    if(isset($errores[$campo]) && !empty($campo)){
        $alerta ="<div class='alerta alerta-error'>" . $errores[$campo] . "</div>";
    }
    
    return $alerta;
}

// El session_start() no hace falta hacerlo porque ya se hace en el fichero conexion.php, que está incluido en el index al principio.
function borrarAlertas(){
    if(isset($_SESSION['registro'])){
        $_SESSION['errores'] = null;  
        unset($_SESSION['errores']);
        
        $_SESSION['registro'] = null;
        unset($_SESSION['registro']);
    }

    if(isset($_SESSION['errores_entrada'])){
        $_SESSION['errores_entrada'] = null;
        unset($_SESSION['errores_entrada']);
    }

    if(isset($_SESSION['errores']['error_actualizacion']) || isset($_SESSION['errores'])){
        $_SESSION['errores']['error_actualizacion'] = null;
        unset($_SESSION['errores']['error_actualizacion']);
        
        $_SESSION['errores'] = null;
        unset($_SESSION['errores']);
    }
    
    if(isset($_SESSION['actualizacion'])){
        $_SESSION['actualizacion'] = null;
        unset($_SESSION['actualizacion']);
    }
    
    return true;
}

function conseguirCategoria($categoria_id){
    global $db;
    
    $query = "SELECT * FROM categorias WHERE id=$categoria_id";
    $categoria = mysqli_query($db, $query);
    $result = array();
    
    if($categoria && mysqli_num_rows($categoria) == 1){
        $result = mysqli_fetch_assoc($categoria);
    }
    
    return $result;
}

function conseguirCategorias(){
    global $db;
    
    $query = "SELECT * FROM categorias ORDER BY id ASC";
    $categorias = mysqli_query($db, $query);
    $result = array();
    
    if($categorias && mysqli_num_rows($categorias) >= 1){
        $result = $categorias;
    }
    
    return $result;
}

function conseguirEntrada($entrada_id){
    global $db;
    
    $query = "SELECT e.*, c.nombre as 'categoria', CONCAT(u.nombre, ' ', u.apellidos) as 'usuario' "
            . "FROM entradas e "
            . "INNER JOIN categorias c ON e.categoria_id = c.id "
            . "INNER JOIN usuarios u ON e.usuario_id = u.id "
            . "WHERE e.id=$entrada_id";
    $entrada = mysqli_query($db, $query);
    $result = array();
    
    if($entrada && mysqli_num_rows($entrada) == 1){
        $result = mysqli_fetch_assoc($entrada);
    }
    
    return $result;
}

function conseguirEntradas($limit = null, $categoria_id = null, $busqueda = null){
    global $db;
    
    $query = "SELECT e.*, c.nombre AS categoria FROM entradas e INNER JOIN categorias c ON e.categoria_id = c.id";
    
    if($categoria_id){
        $query .= " WHERE e.categoria_id = $categoria_id";
    }
    
    if($busqueda){
        $query .= " WHERE e.titulo LIKE '%$busqueda%'";
    }
    
    $query .= " ORDER BY e.id DESC";
    
    if($limit){
        $query .= " LIMIT 4";
    }
    
    $entradas = mysqli_query($db, $query);
    $result = array();
    
    if($entradas && mysqli_num_rows($entradas) >= 1){
        $result = $entradas;
    }
    
    return $result;
}