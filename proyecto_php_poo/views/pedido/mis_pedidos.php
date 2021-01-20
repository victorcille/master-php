<?php if (isset($gestion)): ?>
    <h1>Gestionar Pedidos</h1>
<?php else: ?>
    <h1>Mis Pedidos</h1>
<?php endif; ?>

<table>
    <thead>
        <tr>
            <th>Nº Pedido</th>
            <th>Coste</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($pedido = $pedidos->fetch_object()): ?>
            <tr>
                <td><a href="<?= base_url ?>pedido/detalle&id=<?= $pedido->id ?>"><?= $pedido->id ?></a></td>
                <td><?= $pedido->coste ?>€</td>
                <td><?= $pedido->fecha ?></td>
                <td><?= Utils::showStatus($pedido->estado) ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
