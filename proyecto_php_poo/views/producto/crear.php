<?php if(isset($edit) && isset($product) && is_object($product)): ?>
    <?php $url_action = base_url . "producto/save&id=" . $product->id; ?>
    <h1>Editar producto: <?= $product->nombre ?></h1>
<?php else: ?>
    <?php $url_action = base_url . "producto/save"; ?>
    <h1>Crear nuevo producto</h1>
    
<?php endif; ?>


<form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
    
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" placeholder="<?= isset($product) && is_object($product) ? $product->nombre : ''; ?>" />

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" placeholder="<?= isset($product) && is_object($product) ? $product->descripcion : ''; ?>"></textarea>

    <label for="precio">Precio</label>
    <input type="text" name="precio" placeholder="<?= isset($product) && is_object($product) ? $product->precio : ''; ?>" />

    <label for="stock">Stock</label>
    <input type="number" name="stock" placeholder="<?= isset($product) && is_object($product) ? $product->stock : ''; ?>" />

    <label for="categoria">Categoría</label>
    <select name="categoria">
        <?php $categorias = Utils::getCategorias(); ?>
        <?php while ($categoria = $categorias->fetch_object()): ?>
            <option value="<?= $categoria->id ?>" <?= isset($product) && is_object($product) && $categoria->id == $product->categoria_id ? 'selected' : ''; ?>>
                <?= $categoria->nombre ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="imagen">Imagen</label>
    <?php if(isset($product) && is_object($product) && !empty($product->imagen)): ?>
        <img src="<?=base_url ?>uploads/images/<?= $product->imagen ?>" class="thumb" />
        <br />
    <?php endif; ?>
    <input type="file" name="imagen" />

    <input type="submit" name="enviar" value="Guardar" />
</form>