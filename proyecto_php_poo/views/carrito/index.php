<h1>Carrito de la compra</h1>

<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1): ?>
    <table>
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($carrito as $indice => $elemento):
                $producto = $elemento['producto'];
                $imagen = $producto->imagen == null ? base_url . "assets/img/camiseta.png" : base_url . "uploads/images/" . $producto->imagen;
                ?>
                <tr>
                    <td>
                        <img src="<?= $imagen ?>" class="img_carrito" />
                    </td>
                    <td><a href="<?= base_url ?>producto/detalle&id=<?= $producto->id ?>"><?= $producto->nombre ?></a></td>
                    <td><?= $producto->precio ?></td>
                    <td>
                        <?= $elemento['unidades'] ?>
                        <div class="updown-unidades">
                            <a href="<?= base_url ?>carrito/up&index=<?= $indice ?>" class="button">+</a>
                            <a href="<?= base_url ?>carrito/down&index=<?= $indice ?>" class="button">-</a>
                        </div>
                    </td>
                    <td><a href="<?= base_url ?>carrito/delete&index=<?= $indice ?>" class="button button-carrito button-red">Quitar producto</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br />

    <div class="delete-carrito">
        <a href="<?= base_url ?>carrito/deleteAll" class="button button-delete button-red">Vaciar Carrito</a>
    </div>
    <div class="total-carrito">
        <?php $stats = Utils::statsCarrito(); ?>
        <h3>Precio Total: <?= $stats['total'] ?>€</h3>
        <a href="<?= base_url ?>pedido/hacer" class="button button-pedido">Hacer Pedido</a>
    </div>
  <?php else: ?>
    <p>El carrito está vacío, añade algún producto</p>
<?php endif; ?>