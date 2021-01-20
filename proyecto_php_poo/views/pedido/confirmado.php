<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
    <h1>Pedido confirmado</h1>
    <p>
        Tu pedido ha sido guardado con éxito, una vez que realices la transferencia bancaria a la cuenta 7382947289239ADD
        con el coste del pedido, será procesado y enviado.
    </p>
    <br />
    <?php if (isset($ultimo_pedido)): ?>
        <h3>Datos del pedido</h3>
        <p>Numero de pedido: <?= $ultimo_pedido->id ?></p>
        <p>Total a pagar: <?= $ultimo_pedido->coste ?>€</p>
        <p>
            Productos:
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
        </p>
    <?php endif; ?>
<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
    <h1>Tu pedido no ha podido procesarse</h1>
<?php endif; ?>