<?php
require_once 'models/pedido.php';  // Cargo el modelo para poder trabajar con la clase pedido

class pedidoController{
    public function hacer(){
        
        require_once 'views/pedido/hacer.php';
    }
    
    public function add(){
        if(isset($_SESSION['login'])){
            $usuario_id = $_SESSION['login']->id;
            $coste = Utils::statsCarrito()['total'];
            
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            
            if($provincia && $localidad && $direccion){
                // Guardamos los datos en la bbdd
                $pedido = new Pedido();
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setUsuario_id($usuario_id);
                $pedido->setCoste($coste);
                
                $save = $pedido->save();
                
                // Guardamos la línea de pedido
                $save_linea = $pedido->saveLineaPedido();
                
                if($save && $save_linea){
                    $_SESSION['pedido'] = 'complete';
                }else{
                    $_SESSION['pedido'] = 'failed';
                }
            }else{
                $_SESSION['pedido'] = 'failed';
            }
            
            header("Location:" . base_url . "pedido/confirmado");
        }else{
            header("Location:" . base_url);
        }
    }
    
    public function confirmado(){
        if(isset($_SESSION['login'])){
            $usuario_id = $_SESSION['login']->id;
            $pedido = new Pedido();
            
            // Sacamos el último pedido de ese usuario
            $pedido->setUsuario_id($usuario_id);
            $ultimo_pedido = $pedido->getLastByUser();
            
            // Sacamos los productos de ese pedido
            $pedido->setId($ultimo_pedido->id);
            $productos = $pedido->getProductsByPedido();
        }
        require_once 'views/pedido/confirmado.php';
    }
    
    public function mis_pedidos(){
        Utils::isLoged();
        
        $usuario_id = $_SESSION['login']->id;
        
        $pedido = new Pedido();
        $pedido->setUsuario_id($usuario_id);
        
        // Sacamos todos los pedidos del usuario
        $pedidos = $pedido->getAllByUser();
        
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function detalle(){
        if(isset($_GET['id'])){
            $pedido_id = $_GET['id'];
            
            // Sacamos el pedido
            $pedido = new Pedido();
            $pedido->setId($pedido_id);
            
            $detalle_pedido = $pedido->getOne();
            
            // Sacamos los productos de ese pedido
            $productos = $pedido->getProductsByPedido();
            
            require_once 'views/pedido/detalle.php';
        }else{
            header("Location:" . base_url . 'pedido/mis_pedidos');
        }
    }
    
    public function gestion(){
        Utils::isAdmin();
        $gestion = true;
        
        $pedido = new Pedido();
        $pedidos = $pedido->getAll();
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function updateEstado(){
        Utils::isAdmin();
        if(isset($_POST['enviar'])){
            $pedido_id = isset($_POST['pedido_id']) ? $_POST['pedido_id'] : false;
            $estado = isset($_POST['estado']) ? $_POST['estado'] : false;
            
            if($pedido_id && $estado){
                $pedido = new Pedido();
                $pedido->setId($pedido_id);
                $pedido->setEstado($estado);
                
                $pedido->updateStatus();
                header("Location:" . base_url . "pedido/detalle&id=$pedido_id");
            }
        }else{
            header("Location:" . base_url);
        }
    }
}