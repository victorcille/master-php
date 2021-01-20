<?php

/*
Para poder trabajar con la base de datos, en el fichero index.php hemos cargado el fichero config/db.php.
Como en el index también se cargan los controladores con el autoload y en cada controlador su correspondiente modelo, ya podemos usar aquí
la clase estática Database y su función connect()
*/

class Categoria{
    private $id;
    private $nombre;
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
    
    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    
    public function getAll(){
        $query = "SELECT * FROM categorias ORDER BY id DESC";
        $result = $this->db->query($query);
        
        $categorias = false;
        
        if($result){
            $categorias = $result;
        }
        
        return $categorias;
    }
    
    public function getOne(){
        $query = "SELECT * FROM categorias WHERE id={$this->getId()}";
        $result = $this->db->query($query);
        
        $categoria = false;
        
        if($result){
            $categoria = $result->fetch_object();
        }
        
        return $categoria;
    }
    
    public function save(){
        $query = "INSERT INTO categorias VALUES(null, '{$this->getNombre()}')";
        
        $save = $this->db->query($query);
        
        $result = false;
        
        if($save){
            $result = true;
        }
        
        return $result;
    }
}
