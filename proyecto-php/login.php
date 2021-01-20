<?php

if(isset($_POST['enviar'])){
    // Cargamos datos de conexión a la bbdd
    require_once('./includes/conexion.php');
    
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    $query = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($db, $query);
    
    if($result && mysqli_num_rows($result) == 1){
        $usuario = mysqli_fetch_assoc($result);
        
        // Comprobamos si la contraseña que nos llega es la misma que la almacenada (cifrada). Esta función devuelve true si son iguales o false si no.
        if(password_verify($password, $usuario['password'])){
            $_SESSION['login'] = $usuario;
            
            // Borramos la variable de sesión error_login si existe
            if(isset($_SESSION['error_login'])){
                $_SESSION['error_login'] = null;  
                unset($_SESSION['error_login']);
            }
        }else{
            $_SESSION['error_login'] = "Fallo al hacer login de usuario!!";
        }
    }else{
        $_SESSION['error_login'] = "Fallo al hacer login de usuario!!";
    }
}

header('Location: ./index.php');