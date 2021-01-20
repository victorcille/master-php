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
                <h1>Mis datos</h1>
                <p>Añade nuevas entradas al blog para que los usuarios puedan leerlas y disfrutar de nuestro contenido</p>
                <br />
                
                <!-- MOSTRAR ALERTAS (DE ERROR O DE ÉXITO) -->
                <?php if(isset($_SESSION['registro'])): ?>
                    <div class="alerta alerta-exito">
                        <?= $_SESSION['registro']; ?>
                    </div>
                <?php elseif(isset($_SESSION['errores']['error_registro'])): ?>
                    <div class="alerta alerta-error">
                        <?= $_SESSION['errores']['error_registro']; ?>
                    </div>
                <?php endif; ?>

                <form action="actualizar_usuario.php" method="POST">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" placeholder="<?= $_SESSION['login']['nombre'] ?>" />
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '' ?>

                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" placeholder="<?= $_SESSION['login']['apellidos'] ?>" />
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '' ?>

                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="<?= $_SESSION['login']['email'] ?>" />
                    <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : '' ?>

                    <input type="submit" name="enviar" value="Actualizar" />
                </form>
                <?php borrarAlertas(); // Función del fichero helpers.php importado en el index ?>
            </div>
            <!-- FIN CAJA PRINCIPAL -->
        </div>
                
        <!-- PIE DE PÁGINA -->
        <?php require_once './includes/footer.php'; ?>
        
    </body>
</html>

