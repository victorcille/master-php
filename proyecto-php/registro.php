<?php

if(isset($_POST['enviar'])){
    
    // Cargamos datos de conexión a la bbdd
    require_once('./includes/conexion.php');
    
    // Recogemos los valores del formualrio de registro
    // Lo que hacemos con la función mysqli_real_escape_string es escapar los símbolos raros que se puedan introducir en los campos del formulario tales como "", '', etc
    // y de esta forma no rompa la seguridad de sql
    $nombre = (isset($_POST['nombre']) && !empty($_POST['nombre'])) ? mysqli_real_escape_string($db, trim($_POST['nombre'])) : false;
    $apellidos = isset($_POST['apellidos']) && !empty($_POST['apellidos']) ? mysqli_real_escape_string($db, trim($_POST['apellidos'])) : false;
    $email = isset($_POST['email']) && !empty($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) && !empty($_POST['password']) ? mysqli_real_escape_string($db, trim($_POST['password'])) : false;
    
    // array de errores
    $errores = array();
    
    // Validar los datos antes de guardarlos en la base de datos
    if(empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]/", $nombre) || !$nombre){
        $errores['nombre'] = "El nombre no es válido";
    }
    
    if(empty($apellidos) || is_numeric($apellidos) || preg_match("/[0-9]/", $apellidos) || !$apellidos){
        $errores['apellidos'] = "Los apellidos no son válidos";
    }
    
    if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$email){
        $errores['email'] = "El email no es válido";
    }
    
    if(empty($password) || !$password){
        $errores['password'] = "La contraseña está vacía";
    }
    
    
    if(count($errores) == 0){
        
        // CIFRAMOS LA CONTRASEÑA YA QUE NUNCA SE HA DE ALMACENAR EN BBDD EN TEXTO PLANO
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
        
        // INSERTAMOS USUARIO EN LA BASE DE DATOS (recordar que los datos de la conexión están en el archivo conexion.php)
        $query = "INSERT INTO usuarios VALUES (null, '$nombre', '$apellidos', '$email', '$password_segura', CURDATE());";
        $result = mysqli_query($db, $query);
        
        if($result){
            $_SESSION['registro'] = "El registro se ha completado con éxito!!";
        }else{
            $_SESSION['errores']['error_registro'] = "Fallo al insertar el usuario!!";
        }
        
    }else{
        $_SESSION['errores'] = $errores;
    }
}

header('Location: ./index.php');
