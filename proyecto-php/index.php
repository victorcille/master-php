<?php require_once './includes/conexion.php'; ?>
<?php require_once './includes/helpers.php'; ?>

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
                <h1>Últimas Entradas</h1>
                <?php 
                    $entradas = conseguirEntradas(true);  // Función del fichero helpers.php importado en el index
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
                    endif;
                ?>
                
                <div id="ver-todas">
                    <a href="./entradas.php">Ver todas las entradas</a>
                </div>
            </div>
            <!-- FIN CAJA PRINCIPAL -->
            
        </div>
                
        <!-- PIE DE PÁGINA -->
        <?php require_once './includes/footer.php'; ?>
        
    </body>
</html>
