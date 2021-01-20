<?php
require_once 'models/usuario.php';  // Cargo el modelo para poder trabajar con la clase usuario

class usuarioController{
    public function index(){
        echo "Controlador Usuario, Acción index";
    }
    
    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    
    public function save(){  // Funcion para insertar un nuevo usuario en la bbdd
        if(isset($_POST['enviar'])){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            
            if($nombre && $apellidos && $email && $password){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                $save = $usuario->save();

                if($save){
                    $_SESSION['register'] = "complete";
                }else{
                    $_SESSION['register'] = "failed";
                }
            }else{
                $_SESSION['register'] = "failed";
            }
        }else{
            $_SESSION['register'] = "failed";
        }
        
        header("Location:" . base_url . "usuario/registro");
    }
    
    public function login(){
        if(isset($_POST['enviar'])){
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            
            if($email && $password){
                $usuario = new Usuario();
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                
                $login = $usuario->login();
                
                if($login && is_object($login)){
                    $_SESSION['login'] = $login;
                    
                    if($login->rol == 'admin'){
                        $_SESSION['admin'] = true;
                    }
                }else{
                    $_SESSION['error_login'] = "Identificación fallida!!";
                }
            }else{
                $_SESSION['error_login'] = "Identificación fallida!!";
            }
        }else{
            $_SESSION['error_login'] = "Identificación fallida!!";
        }
        
        header("Location:" . base_url);
    }
    
    public function logout(){
        if(isset($_SESSION['login'])){
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }
        
        header("Location:" . base_url);
    }
}