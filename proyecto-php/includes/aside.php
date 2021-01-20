<!-- BARRA LATERAL -->
<aside id="sidebar">
    
    <div id="buscador" class="bloque">
        <h3>Buscar</h3>
        
        <form action="buscar.php" method="POST">
            <input type="text" name="busqueda" />

            <input type="submit" name="enviar" value="Buscar" />
        </form>
    </div>
    
    <?php if(isset($_SESSION['login'])): ?>
        <div id="usuario-logueado" class="bloque">
            <h3>Bienvenido, <?= $_SESSION['login']['nombre'] . ' ' . $_SESSION['login']['apellidos'] ; ?></h3>
            <div>
            <a href="crear_entrada.php" class="boton boton-verde">Crear Entradas</a>
            <a href="crear_categoria.php" class="boton ">Crear Categoría</a>
            <a href="mis_datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="cerrar_sesion.php" class="boton boton-rojo">Cerrar sesión</a>
            </div>
        </div>
    <?php endif; ?>
    
    <?php if(!isset($_SESSION['login'])): ?>
    
        <div id="login" class="bloque">
            <h3>Identifícate</h3>

            <?php if(isset($_SESSION['error_login'])): ?>
                <div class="alerta alerta-error">
                    <?= $_SESSION['error_login']; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" />

                <label for="password">Contraseña</label>
                <input type="password" name="password" />

                <input type="submit" name="enviar" value="Entrar" />
            </form>
        </div>

        <div id="register" class="bloque">
            <h3>Regístrate</h3>

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

            <form action="registro.php" method="POST">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '' ?>

                <label for="apellidos">Apellidos</label>
                <input type="text" name="apellidos" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '' ?>

                <label for="email">Email</label>
                <input type="email" name="email" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : '' ?>

                <label for="password">Contraseña</label>
                <input type="password" name="password" />
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : '' ?>

                <input type="submit" name="enviar" value="Registrar" />
            </form>
            <?php borrarAlertas(); // Función del fichero helpers.php importado en el index ?>
        </div>
    <?php endif; ?>
</aside>