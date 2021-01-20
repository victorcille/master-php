<?php
    require_once './includes/conexion.php';
    require_once './includes/helpers.php';
    
    $entrada_id = $_GET['id']; 
    $entrada_actual = conseguirEntrada($entrada_id);
    
    if(!isset($entrada_actual['id'])){
        header("Location: ./index.php");
    } 
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>Blog de Videojuegos</title>
        
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
    </head>
    
    <body>
        <!-- CABECERA -->
        <?php require_once './includes/cabecera.php'; ?>
        
        <div id="contenedor">
            <!-- BARRA LATERAL -->
            <?php require_once './includes/aside.php'; ?>
            
            <!-- CAJA PRINCIPAL -->
            <div id="principal">
                <?php 
                    if(!empty($entrada_actual)):
                ?>
                        <h1><?= $entrada_actual['titulo'] ?></h1>
                        <a href="./categoria.php?id=<?= $entrada_actual['categoria_id'] ?>">
                            <h2><?= $entrada_actual['categoria'] ?></h2>
                        </a>
                        <h4><?= $entrada_actual['fecha'] . ' | ' . $entrada_actual['usuario'] ?></h4>
                        <p><?= $entrada_actual['descripcion'] ?></p>
                <?php 
                        if(isset($_SESSION['login']) && $_SESSION['login']['id'] == $entrada_actual['usuario_id']):  
                ?>
                            <br />
                            <a href="editar_entrada.php?id=<?= $entrada_id ?>" class="boton boton-verde">Editar Entrada</a>
                            <a href="eliminar_entrada.php?id=<?= $entrada_id ?>" class="boton ">Borrar Entrada</a>
                <?php
                        endif;
                    else:
                ?>
                    <div class="alerta alerta-error">
                        No hay entradas en esta categoría
                    </div>
                <?php 
                    endif;
                ?>
            </div>
            <!-- FIN CAJA PRINCIPAL -->
            
        </div>
                
        <!-- PIE DE PÁGINA -->
        <?php require_once './includes/footer.php'; ?>
        
    </body>
</html>