<?php
require_once './includes/conexion.php';
require_once './includes/redirect.php';
require_once './includes/helpers.php';
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
                <h1>Crear Categorías</h1>
                <p>Añade nuevas categorías al blog para que los usuarios puedan usarlas al crear sus entradas</p>
                <br />
                
                <form action="guardar_categoria.php" method="POST">
                    <label for="nombre">Nombre de la categoría</label>
                    <input type="text" name="nombre" />
                    
                    <input type="submit" name="enviar" value="Guardar" />
                </form>
            </div>
            <!-- FIN CAJA PRINCIPAL -->
        </div>
                
        <!-- PIE DE PÁGINA -->
        <?php require_once './includes/footer.php'; ?>
        
    </body>
</html>
