<?php

/*
Para poder trabajar con la base de datos, en el fichero index.php hemos cargado el fichero config/db.php.
Como en el index también se cargan los controladores con el autoload y en cada controlador su correspondiente modelo, ya podemos usar aquí
la clase estática Database y su función connect()
*/

class Usuario{
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function getRol() {
        return $this->rol;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellidos($apellidos) {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }
    
    public function save(){
        $query = "INSERT INTO usuarios "
                . "VALUES("
                . "null, "
                . "'{$this->getNombre()}', "
                . "'{$this->getApellidos()}', "
                . "'{$this->getEmail()}', "
                . "'{$this->getPassword()}', "
                . "'user', "
                . "null)";
        
        $save = $this->db->query($query);
        
        $result = false;
        
        if($save){
            $result = true;
        }
        
        return $result;
    }
    
    public function login(){
        $email = $this->email;
        $password = $this->password;
        
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($query);
        
        $result = false;
        
        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();
            
            // Verificamos contraseña
            $verify = password_verify($password, $usuario->password);
            
            if($verify){
                $result = $usuario;
            }
        }
        
        return $result;
    }
}