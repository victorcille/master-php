<?php

// Este fichero contendrá funciones útiles que podrán ser invocadas directamente sin necesidad de instanciar la clase
class Utils{
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
        }
        
        return $name;
    }
    
    public static function isAdmin(){  // Función para comprobar si un usuario es administrador
        if(!isset($_SESSION['admin'])){
            header("Location" . base_url);
        }else{
            return true;
        }
    }
    
    public static function isLoged(){  // Función para comprobar si un usuario está logueado
        if(!isset($_SESSION['login'])){
            header("Location" . base_url);
        }else{
            return true;
        }
    }
    
    public static function getCategorias(){  // Función para obtener todas las categorías
        require_once 'models/categoria.php';
        
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        return $categorias;
    }
    
    public static function statsCarrito(){
        $stats = array(
            'count' => 0,
            'total' => 0
        );
        if(isset($_SESSION['carrito'])){
            $carrito = $_SESSION['carrito'];
            
            // Sacamos el número de elementos que tenemos en el carrito
            $stats['count'] = count($carrito);
            
            // Sacamos la suma total de los precios de los productos en el carrito
            foreach($carrito as $producto){
                $stats['total'] += $producto['precio']*$producto['unidades'];
            }
            
        }
        
        return $stats;
    }
    
    public static function showStatus($status){
        $estado = false;
        
        switch ($status){
            case "preparation":
                $estado = "En preparación";
                break;
            case "ready":
                $estado = "Preparado para envío";
                break;
            case "sended":
                $estado = "Enviado";
                break;
            default:
                $estado = "Pendiente";
        }
        
        return $estado;
    }
}
