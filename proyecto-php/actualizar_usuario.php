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
    $usuario = $_SESSION['login'];
    
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
    
    if(count($errores) == 0){
        // COMPROBAR SI YA HAY ALGUIEN CON UN EMAIL IGUAL
        $query ="SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db, $query);
        $isset_user = mysqli_fetch_assoc($isset_email);
        
        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){  // SI NO HAY NINGÚN RESULTADO SIGNIFICA QUE NO HAY NADIE QUE TENGA ESE MISMO EMAIL
            // ACTUALIZAMOS USUARIO EN LA BASE DE DATOS
            $query = "UPDATE usuarios SET nombre = '$nombre', apellidos = '$apellidos', email = '$email', fecha = CURDATE() WHERE id = {$usuario['id']};";
            $result = mysqli_query($db, $query);

            if($result){
                // ACTAULIZAMOS LA VARIABLE DE SESIÓN CON LOS NUEVOS DATOS
                $_SESSION['login']['nombre'] = $nombre;
                $_SESSION['login']['apellidos'] = $apellidos;
                $_SESSION['login']['email'] = $email;

                $_SESSION['actualizacion'] = "Tus datos se han actualizado con éxito!!";
            }else{
                $_SESSION['errores']['error_actualizacion'] = "Fallo al actualizar tus datos!!";
            }
        }else{
            $_SESSION['errores']['email'] = "Ya hay un usuario con ese email!!";
        }
    }else{
        $_SESSION['errores'] = $errores;
    }
}

header('Location: ./mis_datos.php');

