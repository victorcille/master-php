<?php
require_once 'models/producto.php';  // Cargo el modelo para poder trabajar con la clase producto

class productoController{
    public function index(){
        $producto = new Producto();
        $productos = $producto->getRandom(6);
        
        // Renderizar una vista
        require_once 'views/producto/destacados.php';
    }
    
    public function detalle(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $producto = new Producto();
            $producto->setId($id);
            
            $product = $producto->getOne();
            
            require_once 'views/producto/detalle.php'; 
        }else{
            header("Location:" . base_url);
        }
    }
    
    public function gestion(){
        Utils::isAdmin();
        
        $producto = new Producto();
        $productos = $producto->getAll();
        
        require_once 'views/producto/gestion.php';
    }
    
    public function crear(){
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }
    
    public function save(){  // Funcion que servirá anto para insertar como para editar un registro en la bbdd
        Utils::isAdmin();
        
        if(isset($_POST['enviar'])){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            //$imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
            
            if($nombre && descripcion && $precio && $stock && $categoria){
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);
                
                // Guardar la imagen
                if(isset($_FILES['imagen'])){
                    $file = $_FILES['imagen'];
                    $file_name = $file['name'];
                    $file_mimetype = $file['type'];

                    if($file_mimetype == 'image/jpg' || $file_mimetype == 'image/jpeg' || $file_mimetype == 'image/png' || $file_mimetype == 'image/gif'){
                        if(!is_dir('uploads/images')){
                            mkdir('uploads/images', 0777, true);
                        }
                        move_uploaded_file($file['tmp_name'], 'uploads/images/'.$file_name);
                        $producto->setImagen($file_name);
                    }
                }
                
                // Si me llega por parámetro GET el id del producto, editaremos. Si no, insertamos un registro nuevo
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    
                    $producto->setId($id);
                    
                    $save = $producto->edit();
                }else{
                    $save = $producto->save();
                }
                
                if($save){
                    $_SESSION['producto'] = "complete";
                }else{
                    $_SESSION['producto'] = "failed";
                }
            }else{
                $_SESSION['producto'] = "failed";
            }
        }else{
            $_SESSION['producto'] = "failed";
        }
        
        header("Location:" . base_url . "producto/gestion");
    }
    
    public function editar(){
        Utils::isAdmin();
        if(isset($_GET['id'])){
            $edit = true;
            $id = $_GET['id'];
            
            $producto = new Producto();
            $producto->setId($id);
            
            $product = $producto->getOne();
            
            require_once 'views/producto/crear.php';  // Reutilizamos la vista de la creación
        }else{
            header("Location:" . base_url . "producto/gestion");
        }
    }
    
    public function eliminar(){
        Utils::isAdmin();
        
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $producto = new Producto;
            $producto->setId($id);
            
            $delete = $producto->delete();
            
            if($delete){
                $_SESSION['delete'] = "complete";
            }else{
                $_SESSION['delete'] = "failed";
            }
        }else{
            $_SESSION['delete'] = "failed";
        }
        
        header("Location:" . base_url . "producto/gestion");
    }
}