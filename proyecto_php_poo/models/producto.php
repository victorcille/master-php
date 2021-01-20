<?php

/*
Para poder trabajar con la base de datos, en el fichero index.php hemos cargado el fichero config/db.php.
Como en el index también se cargan los controladores con el autoload y en cada controlador su correspondiente modelo, ya podemos usar aquí
la clase estática Database y su función connect()
*/

class Producto{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getCategoria_id() {
        return $this->categoria_id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getStock() {
        return $this->stock;
    }

    function getOferta() {
        return $this->oferta;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCategoria_id($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setPrecio($precio) {
        $this->precio = $this->db->real_escape_string($precio);
    }

    function setStock($stock) {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function setOferta($oferta) {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function getAll(){
        $query = "SELECT * FROM productos ORDER BY id DESC";
        $result = $this->db->query($query);
        
        $productos = false;
        
        if($result){
            $productos = $result;
        }
        
        return $productos;
    }
    
    public function getOne(){
        $query = "SELECT * FROM productos WHERE id={$this->getId()}";
        $result = $this->db->query($query);
        
        $producto = false;
        
        if($result){
            $producto = $result->fetch_object();
        }
        
        return $producto;
    }
    
    public function getAllByCategoria(){
        $query = "SELECT p.* FROM productos p INNER JOIN categorias c ON p.categoria_id = c.id WHERE p.categoria_id={$this->getCategoria_id()}";
        $result = $this->db->query($query);
        
        $productos = false;
        
        if($result){
            $productos = $result;
        }
        
        return $productos;
    }
    
    public function getRandom($limit){
        $query = "SELECT * FROM productos ORDER BY RAND() LIMIT $limit";
        $result = $this->db->query($query);
        
        $productos = false;
        
        if($result){
            $productos = $result;
        }
        
        return $productos;
    }
    
    public function save(){
        $query = "INSERT INTO productos "
                . "VALUES("
                . "null, "
                . "{$this->getCategoria_id()}, "
                . "'{$this->getNombre()}', "
                . "'{$this->getDescripcion()}', "
                . "{$this->getPrecio()}, "
                . "{$this->getStock()}, "
                . "null, "
                . "CURDATE(), "
                . "'{$this->getImagen()}')";
        
        $save = $this->db->query($query);
        
        $result = false;
        
        if($save){
            $result = true;
        }
        
        return $result;
    }
    
    public function edit(){
        $query = "UPDATE productos "
                . "SET categoria_id={$this->getCategoria_id()}, "
                . "nombre='{$this->getNombre()}', "
                . "descripcion='{$this->getDescripcion()}', "
                . "precio={$this->getPrecio()}, "
                . "stock={$this->getStock()}, "
                . "fecha=CURDATE()";
        if($this->getImagen() != null){
            $query .= ", imagen='{$this->getImagen()}'";
        }
        
        $query .= " WHERE id={$this->getId()}";
        
        $result = $this->db->query($query);
        
        $edit = false;
        
        if($result){
            $edit = true;
        }
        
        return $edit;
    }
    
    public function delete(){
        $query = "DELETE FROM productos WHERE id={$this->id}";
        $result = $this->db->query($query);
        
        $delete = false;
        
        if($result){
            $delete = true;
        }
        
        return $delete;
    }
}
