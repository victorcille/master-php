<?php
require_once 'models/producto.php';  // Cargo el modelo para poder trabajar con la clase producto

class carritoController{
    public function index(){
        if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
            $carrito = $_SESSION['carrito'];
        }else{
            $carrito = array();
        }
        
        require_once 'views/carrito/index.php';
    }
    
    public function add(){
        if(isset($_GET['id'])){
            $producto_id = $_GET['id'];  // Guardamos en una variable el id del producto que nos llega por GET
        }else{
            header("Location:" . base_url);
        }
        
        // Si ya hay elementos en el carrito, sumamos 1 unidad si el producto ya se encuentra en él
        if(isset($_SESSION['carrito'])){
            $contador = 0;
            foreach($_SESSION['carrito'] as $indice => $elemento){
                if($elemento['id_producto'] == $producto_id){
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $contador++;
                }
            }
        }
        
        // Si no hay ningún producto en el carrito, lo metemos nuevo
        if(!isset($contador) || $contador == 0){
            $producto = new Producto();
            $producto->setId($producto_id);
            
            // Conseguimos el producto
            $producto = $producto->getOne();
            
            // Añadimos el elemento al carrito
            if(is_object($producto)){
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }
        
        header("Location:" . base_url . "carrito/index");
    }
    
    public function delete(){  // Función para borrar un elemento del carrito
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            unset ($_SESSION['carrito'][$index]);
        }
        
        header("Location:" . base_url . "carrito/index");
    }
    
    public function deleteAll(){  // Función para borrar todos los elementos del carrito
        unset ($_SESSION['carrito']);
        header("Location:" . base_url . "carrito/index");
    }
    
    public function up(){  // Función para sumar unidades de un producto al carrito
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;
        }
        
        header("Location:" . base_url . "carrito/index");
    }
    
    public function down(){  // Función para restar unidades de un producto al carrito
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            if($_SESSION['carrito'][$index]['unidades'] == 0){  // Si llegamos a 0, borramos el producto del carrito
                unset ($_SESSION['carrito'][$index]);
            }
        }
        
        header("Location:" . base_url . "carrito/index");
    }
}
