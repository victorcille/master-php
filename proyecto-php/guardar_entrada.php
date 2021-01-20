<?php

if(isset($_POST['enviar'])){
    
    // Cargamos datos de conexión a la bbdd
    require_once('./includes/conexion.php');
    
    $titulo = (isset($_POST['titulo']) && !empty($_POST['titulo'])) ? mysqli_real_escape_string($db, trim($_POST['titulo'])) : false;
    $descripcion = (isset($_POST['descripcion']) && !empty($_POST['descripcion'])) ? mysqli_real_escape_string($db, trim($_POST['descripcion'])) : false;
    $categoria = (isset($_POST['categoria']) && !empty($_POST['categoria'])) ? (int)$_POST['categoria'] : false;
    $usuario = $_SESSION['login']['id'];
    
    // array de errores
    $errores = array();
    
    // Validar los datos antes de guardarlos en la base de datos
    if(empty($titulo) || !$titulo){
        $errores['titulo'] = "El título no es válido";
    }
    
    if(empty($descripcion) || !$descripcion){
        $errores['descripcion'] = "La descripción no es válida";
    }
    
    if(empty($categoria) || !is_numeric($categoria) || !$categoria){
        $errores['categoria'] = "La categoría no es válida";
    }
    
    if(count($errores) == 0){
        if(isset($_GET['editar'])){
            $entrada_id = $_GET['editar'];
            
            // ACTUALIZAMOS ENTRADA EN LA BASE DE DATOS
            $query = "UPDATE entradas "
                    . "SET categoria_id = $categoria, "
                    . "titulo = '$titulo', "
                    . "descripcion = '$descripcion', "
                    . "fecha = CURDATE()"
                    . "WHERE id = $entrada_id AND usuario_id = $usuario";
        }else{
            // INSERTAMOS ENTRADA EN LA BASE DE DATOS
            $query = "INSERT INTO entradas VALUES (null, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());";
        }
        $result = mysqli_query($db, $query);
        
        header('Location: ./index.php');
    }else{
        $_SESSION['errores_entrada'] = $errores;
        if(isset($_GET['editar'])){
            $entrada_id = $_GET['editar'];
            header('Location: ./editar_entrada.php?editar='.$entrada_id);
        }else{
            header('Location: ./crear_entrada.php');
        }
    }
}




