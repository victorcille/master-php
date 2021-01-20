<?php if (isset($product)): ?>
    <h1><?= $product->nombre ?></h1>
    <div id="detail-product">
        <?php $imagen = $product->imagen == null ? base_url . "assets/img/camiseta.png" : base_url . "uploads/images/" . $product->imagen; ?>
        <div class="image">
            <img src="<?= $imagen ?>" />
        </div>
        
        <div class="data">
            <p class="description"><?= $product->descripcion ?>€</p>
            <p class="price"><?= $product->precio ?>€</p>
            <a href="<?= base_url ?>carrito/add&id=<?= $product->id ?>" class="button">Comprar</a>
        </div>
    </div>
<?php else: ?>
    <h1>El producto no existe</h1>
<?php endif; ?>