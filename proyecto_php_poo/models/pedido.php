<?php

/*
Para poder trabajar con la base de datos, en el fichero index.php hemos cargado el fichero config/db.php.
Como en el index también se cargan los controladores con el autoload y en cada controlador su correspondiente modelo, ya podemos usar aquí
la clase estática Database y su función connect()
*/

class Pedido{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getProvincia() {
        return $this->provincia;
    }

    function getLocalidad() {
        return $this->localidad;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCoste() {
        return $this->coste;
    }

    function getEstado() {
        return $this->estado;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setProvincia($provincia) {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    function setLocalidad($localidad) {
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    function setDireccion($direccion) {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setCoste($coste) {
        $this->coste = $coste;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }
    
    public function getAll(){
        $query = "SELECT * FROM pedidos ORDER BY id DESC";
        $result = $this->db->query($query);
        
        $pedidos = false;
        
        if($result){
            $pedidos = $result;
        }
        
        return $pedidos;
    }
    
    public function getAllByUser(){
        $query = "SELECT * FROM pedidos WHERE usuario_id={$this->getUsuario_id()} ORDER BY id DESC";
        $result = $this->db->query($query);
        
        $pedidos = false;
        
        if($result){
            $pedidos = $result;
        }
        
        return $pedidos;
    }
    
    public function getOne(){
        $query = "SELECT * FROM pedidos WHERE id={$this->getId()}";
        $result = $this->db->query($query);
        
        $pedido = false;
        
        if($result){
            $pedido = $result->fetch_object();
        }
        
        return $pedido;
    }
    
    public function getLastByUser(){
        $query = "SELECT p.id as id, p.coste as coste FROM pedidos p "
                . "WHERE p.usuario_id={$this->getUsuario_id()} "
                . "ORDER BY p.id DESC LIMIT 1";
                
        $result = $this->db->query($query);
        
        $pedido = false;
        
        if($result){
            $pedido = $result->fetch_object();
        }
        
        return $pedido;
    }
    
    public function getProductsByPedido(){
        $query = "SELECT prod.*, lp.unidades FROM lineas_pedidos lp "
                . "INNER JOIN productos prod ON lp.producto_id = prod.id "
                . "WHERE lp.pedido_id={$this->getId()}";
                
        $result = $this->db->query($query);
        
        $productos = false;
        
        if($result){
            $productos = $result;
        }
        
        return $productos;
    }
    
    public function save(){
        $query = "INSERT INTO pedidos "
                . "VALUES("
                . "null, "
                . "{$this->getUsuario_id()}, "
                . "'{$this->getProvincia()}', "
                . "'{$this->getLocalidad()}', "
                . "'{$this->getDireccion()}', "
                . "{$this->getCoste()}, "
                . "'confirmed', "
                . "CURDATE(), "
                . "CURTIME())";
        
        $save = $this->db->query($query);
        
        $result = false;
        
        if($save){
            $result = true;
        }
        
        return $result;
    }
    
    public function saveLineaPedido(){
        $query = "SELECT LAST_INSERT_ID() as 'pedido_id'";  // Esta función el id del último registro insertado en la tabla
        $resultado = $this->db->query($query);
        $pedido_id = $resultado->fetch_object()->pedido_id;  // Llamo a pedido_id porque así es el alias que le he puesto en la query
        
        foreach($_SESSION['carrito'] as $elemento){
            $producto = $elemento['producto'];
            $unidades = $elemento['unidades'];
            
            $query = "INSERT INTO lineas_pedidos "
                    . "VALUES("
                    . "null, "
                    . "$pedido_id, "
                    . "{$producto->id}, "
                    . "$unidades)";
                    
            $save = $this->db->query($query);
        }
        
        $result = false;
        
        if($save){
            $result = true;
        }
        
        return $result;
    }
    
    public function updateStatus(){
        $query = "UPDATE pedidos "
                . "SET estado='{$this->getEstado()}' WHERE id={$this->getId()}";
        
        $result = $this->db->query($query);
        
        $edit = false;
        
        if($result){
            $edit = true;
        }
        
        return $edit;
    }
}