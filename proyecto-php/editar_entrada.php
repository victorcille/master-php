<?php
    require_once './includes/conexion.php';
    require_once './includes/redirect.php';
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
                <h1>Editar Entrada</h1>
                <p>Edita la entrada de <?= $entrada_actual['titulo'] ?></p>
                <br />
                
                <form action="guardar_entrada.php?editar=<?= $entrada_id ?>" method="POST">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" placeholder="<?= $entrada_actual['titulo'] ?>" />
                    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'titulo') : '' ?>
                    
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" rows="4" cols="50" placeholder="<?= $entrada_actual['descripcion'] ?>"></textarea>
                    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'descripcion') : '' ?>
                    
                    <label for="categoria">Categoría</label>
                    <select name="categoria">
                        <?php 
                            $categorias = conseguirCategorias();  // Función del fichero helpers.php importado en el index
                            if(!empty($categorias)):
                                while($categoria = mysqli_fetch_assoc($categorias)):
                        ?>
                                    <option value="<?= $categoria['id'] ?>">
                                        <?= $categoria['nombre'] ?>
                                    </option>
                        <?php 
                                endwhile;
                            endif;
                        ?>
                    </select>
                    <?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'], 'categoria') : '' ?>
                    
                    <input type="submit" name="enviar" value="Guardar" />
                </form>
                <?php borrarAlertas(); // Función del fichero helpers.php importado en el index ?>
            </div>
            <!-- FIN CAJA PRINCIPAL -->
            
        </div>
                
        <!-- PIE DE PÁGINA -->
        <?php require_once './includes/footer.php'; ?>
        
    </body>
</html>
