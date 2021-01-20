<?php
session_start();
require_once 'autoload.php';  // Cargamos el fichero autoload para que se carguen todos los controladores
require_once 'config/parameters.php';  // Cargamos el fichero donde hemos configurado los parámetros
require_once 'config/db.php';  // Cargamos el fichero con la conexión a la base de datos para luego poder utilizarla en los modelos
require_once 'helpers/utils.php';

function show_error(){
    $error = new errorController();
    $error->index();
}
?>
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <title>Tienda de Camisetas</title>
        <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
    </head>
    <body>
        <div id="container">
            <?php require_once 'views/layout/header.php'; ?>

            <div id="content">
                <?php require_once 'views/layout/sidebar.php'; ?>
                
                <!-- CONTENIDO CENTRAL -->
                <div id="central">
                    <?php
                    
                    if(isset($_GET['controller'])){
                        $nombre_controlador = $_GET['controller'].'Controller';
                            
                    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
                        $nombre_controlador = controller_default;
                    }else{
                            show_error();
                            exit();
                    }

                    if(class_exists($nombre_controlador)){	
                            $controlador = new $nombre_controlador();

                            if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
                                $action = $_GET['action'];
                                $controlador->$action();
                                
                            }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
                                $action = action_default;
                                $controlador->$action();
                            }else{
                                show_error();
                            }
                    }else{
                        show_error();
                    }
                    ?>
                </div>
            </div>

            <?php require_once 'views/layout/footer.php'; ?>
        </div>
    </body>
</html>

