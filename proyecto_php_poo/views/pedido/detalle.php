<h1>Detalle del pedido</h1>

<?php if (isset($detalle_pedido)): ?>
        <?php if (isset($_SESSION['admin'])): ?>
            <h3>Cambiar estado del pedido</h3>
            <form action="<?= base_url ?>pedido/updateEstado" method="POST">
                <input type="hidden" name="pedido_id" value="<?= $detalle_pedido->id ?>" />
                <select name="estado">
                    <option value="confirmed" <?= $detalle_pedido->estado == 'confirmed' ? 'selected' : '' ?>>Pendiente</option>
                    <option value="preparation" <?= $detalle_pedido->estado == 'preparation' ? 'selected' : '' ?>>En preparación</option>
                    <option value="ready" <?= $detalle_pedido->estado == 'ready' ? 'selected' : '' ?>>Preparado para envío</option>
                    <option value="sended" <?= $detalle_pedido->estado == 'sended' ? 'selected' : '' ?>>Enviado</option>
                </select>
                
                <input type="submit" name="enviar" value="Cambiar estado" />
            </form>
            <br />
        <?php endif; ?>
            
        <h3>Dirección de envío</h3>
        <p>Provincia: <?= $detalle_pedido->provincia ?></p>
        <p>Localidad: <?= $detalle_pedido->localidad ?></p>
        <p>Dirección: <?= $detalle_pedido->direccion ?></p>
        <br />
        
        <h3>Datos del pedido</h3>
        <p>Estado: <?= Utils::showStatus($detalle_pedido->estado) ?></p>
        <p>Numero de pedido: <?= $detalle_pedido->id ?></p>
        <p>Total a pagar: <?= $detalle_pedido->coste ?>€</p>
        <p>Productos:</p>
        <br />
        
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($producto = $productos->fetch_object()): ?>
                    <?php $imagen = $producto->imagen == null ? base_url . "assets/img/camiseta.png" : base_url . "uploads/images/" . $producto->imagen; ?>
                    <tr>
                        <td>
                            <img src="<?= $imagen ?>" class="img_carrito" />
                        </td>
                        <td><a href="<?= base_url ?>producto/detalle&id=<?= $producto->id ?>"><?= $producto->nombre ?></a></td>
                        <td><?= $producto->precio ?></td>
                        <td><?= $producto->unidades ?></td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>