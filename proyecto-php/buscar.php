<?php
    require_once './includes/conexion.php';
    require_once './includes/helpers.php';
    
    if(!isset($_POST['busqueda'])){
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
                <h1>Búsqueda: <?= $_POST['busqueda'] ?></h1>
                <?php 
                    $busqueda = $_POST['busqueda'];
                    $entradas = conseguirEntradas(null, null, $busqueda);
                    
                    if(!empty($entradas)):
                        while($entrada = mysqli_fetch_assoc($entradas)):
                ?>
                            <article class="entrada">
                                <a href="./entrada.php?id=<?= $entrada['id'] ?>">
                                    <h2><?= $entrada['titulo'] ?></h2>
                                    <span class="fecha"><?= $entrada['categoria'] . " | " . $entrada['fecha'] ?></span>
                                    <p><?= substr($entrada['descripcion'], 0, 180) . "..." ?></p>
                                </a>
                            </article>
                <?php 
                        endwhile;
                    else:
                ?>
                <br />
                <div class="alerta alerta-error">
                    No hay entradas para esta búsqueda
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