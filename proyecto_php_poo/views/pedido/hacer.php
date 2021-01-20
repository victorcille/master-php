<?php if (isset($_SESSION['login'])): ?>
    <h1>Realizar pedido</h1>
    <p>
        <a href="<?= base_url ?>carrito/index">Ver Carrito</a>
    </p>
    <br />
    <h3>Dirección de envío</h3>
    <form action="<?= base_url ?>pedido/add" method="POST">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" required />

        <label for="localidad">Localidad</label>
        <input type="text" name="localidad" required />
        
        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" required />

        <input type="submit" name="enviar" value="Confirmar pedido" />
    </form>
<?php else: ?>
    <h1>Necesitas estar identificado</h1>
    <p>Necesitas estar logueado en la web para poder realizar tu pedido</p>
<?php endif; ?>