<?php
require_once 'models/categoria.php';  // Cargo el modelo para poder trabajar con la clase categoria
require_once 'models/producto.php';  // Cargo el modelo para poder trabajar con la clase producto

class categoriaController{
    public function index(){
        Utils::isAdmin();
        
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        // Como estamos cargando la vista después de haber obtenido las categorías (array), ahora podemos usar esta variable en el fichero index.php
        require_once 'views/categoria/index.php';
    }
    
    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            // Conseguir Categoría
            $categoria = new Categoria();
            $categoria->setId($id);
            
            $categoria = $categoria->getOne();
            
            // Conseguir Productos de esa categoría
            $producto = new Producto;
            $producto->setCategoria_id($id);
            
            $productos = $producto->getAllByCategoria();
            
            require_once 'views/categoria/ver.php';
        }else{
            header("Location:" . base_url);
        }
    }
    
    public function crear(){
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }
    
    public function save(){  // Funcion para insertar una nuevo categoria en la bbdd
        Utils::isAdmin();
        
        if(isset($_POST['enviar'])){
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            
            if($nombre){
                $categoria = new Categoria();
                $categoria->setNombre($nombre);

                $save = $categoria->save();
            }
        }
        
        header("Location:" . base_url . "categoria/index");
    }
}