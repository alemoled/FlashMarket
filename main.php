<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Flash Market</title>
  <link rel="stylesheet" href="css/css.css"/>
</head>
<body>
  <div class="container">
  <header>
    <div class="top-bar">
      <img src="logos/logo.png" alt="Flash Market Logo" class="logo" />

      <input type="text" placeholder="Búsqueda..." class="search-bar" />
      <button class="search-btn">
        <img src="logos/lupa.png" alt="" width="10" height="10">
      </button>



      <button id="currency-btn" class="icon-btn">
        <img src="logos/divisa.png" alt="Moneda" />
        <span id="currency-label">EUR</span>
      </button>

      <button class="icon-btn">
        <img src="logos/lista.png" alt="Favoritos" />
        <span>Lista y Favoritos</span>
      </button>

      <button class="icon-btn">
        <img src="logos/usuario.png" alt="Usuario" />
        <span>Buenas, usuario</span>
      </button>

      <a href="html/carrito.php"class="icon-btn">
        <img src="logos/carrito.png" alt="Carrito" />
      </a>
    </div>
    <nav class="nav-bar">
      <button class="menu-btn">☰ Categorías</button>
      <a href="#">Categoría 1</a>
      <a href="#">Categoría 2</a>
      <a href="#">Categoría 3</a>
      <a href="#">Categoría 4</a>
      <a href="#">Categoría 5</a>
      <a href="#">Categoría 6</a>
      <a href="#">Categoría 7</a>
      <a href="#">Categoría 8</a>
    
      <!-- Menú desplegable oculto inicialmente -->
      <div id="category-dropdown" class="dropdown hidden">
        <a href="#">Categoría 9</a>
        <a href="#">Categoría 10</a>
        <a href="#">Categoría 11</a>
        <a href="#">Categoría 12</a>
        <a href="#">Categoría 13</a>
        <a href="#">Categoría 14</a>
        <a href="#">Categoría 15</a>
        <a href="#">Categoría 16</a>
        <a href="#">Categoría 17</a>
        <a href="#">Categoría 18</a>
        <a href="#">Categoría 19</a>
        <a href="#">Categoría 20</a>
      </div>
    </nav>
  </header>

  <main>
    <section class="carousel">
      <div class="carousel-container">
        <img src="images/slide1.jpg" alt="Oferta 1" class="carousel-slide active" />
        <img src="images/slide2.jpg" alt="Oferta 2" class="carousel-slide" />
        <img src="images/slide3.jpg" alt="Oferta 3" class="carousel-slide" />
    
        <button class="carousel-btn prev">&#10094;</button>
        <button class="carousel-btn next">&#10095;</button>
      </div>
    </section>
    

    <section class="product-list">
      <div class="product-list">
        <div class="product" data-price="10">
          <div class="product-img">
            <img src="https://placehold.co/150" alt="Producto 1" />
          </div>
          <div class="product-info">
            <span class="product-name">Producto 1</span>
            <span class="product-price">€10.00</span>
          </div>
        </div>
      
        <div class="product" data-price="15">
          <div class="product-img">
            <img src="https://placehold.co/150" alt="Producto 2" />
          </div>
          <div class="product-info">
            <span class="product-name">Producto 2</span>
            <span class="product-price">€15.00</span>
          </div>
        </div>

        <div class="product" data-price="20">
          <div class="product-img">
            <img src="https://placehold.co/150" alt="Producto 3" />
          </div>
          <div class="product-info">
            <span class="product-name">Producto 3</span>
            <span class="product-price">€20.00</span>
          </div>
        </div>

        <div class="product" data-price="15">
          <div class="product-img">
            <img src="https://placehold.co/150" alt="Producto 4" />
          </div>
          <div class="product-info">
            <span class="product-name">Producto 4</span>
            <span class="product-price">€15.00</span>
          </div>
        </div>
      </div>   
    </section>
  </main>

  <footer>
    Footer
  </footer>
</div>
<script src="scripts/scripts.js"></script>

    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit;
    }
    ?>
</body>
</html>