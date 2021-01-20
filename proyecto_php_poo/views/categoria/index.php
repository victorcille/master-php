<h1>Gestionar Categorías</h1>

<a href="<?= base_url ?>categoria/crear" class="button button-small">Crear Categoría</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($categoria = $categorias->fetch_object()): ?>
            <tr>
                <td><?= $categoria->id; ?></td>
                <td><?= $categoria->nombre; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
