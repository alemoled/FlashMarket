<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Carrito de la Compra</title>
  <link rel="stylesheet" href="../css/carrito.css">
</head>
<body>

<section class="carrito">
  <h2>Mi cesta</h2>
  <div class="producto-grid">
    <?php for ($i = 1; $i <= 4; $i++): ?>
      <div class="producto">
        <img src="https://placehold.co/150" alt="Producto <?= $i ?>">
        <span class="nombre">Producto <?= $i ?></span>
        <span class="precio">€<?= 10 + $i * 2 ?>.00</span>
      </div>
    <?php endfor; ?>
  </div>
</section>

<section class="recomendados">
  <h3>Recomendados</h3>
  <div class="producto-grid">
    <?php for ($i = 1; $i <= 4; $i++): ?>
      <div class="producto">
        <img src="https://placehold.co/150" alt="Recomendado <?= $i ?>">
        <span class="nombre">Recomendado <?= $i ?></span>
        <span class="precio">€<?= 8 + $i ?>.00</span>
      </div>
    <?php endfor; ?>
  </div>
</section>

</body>
</html>
