<!-- CABECERA -->
<header id="header">
    <div id="logo">
        <img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta Logo" />
        <a href="<?= base_url ?>">
            Tienda de camisetas
        </a>
    </div>
</header>

<!-- MENÚ -->
<?php $categorias = Utils::getCategorias(); ?>
<nav id="menu">
    <ul>
        <li>
            <a href="<?= base_url ?>">Inicio</a>
        </li>
        <?php while ($categoria = $categorias->fetch_object()): ?>
            <li>
                <a href="<?= base_url ?>categoria/ver&id=<?= $categoria->id ?>"><?= $categoria->nombre; ?></a>
            </li>
        <?php endwhile; ?>
    </ul>
</nav>