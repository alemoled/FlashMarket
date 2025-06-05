<?php
session_start();
require 'API.php';
$pdo = dbConnect();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Optionally store the product in the session
    if (isset($_POST['id'], $_POST['title'], $_POST['description'], $_POST['price'], $_POST['image'], $_POST['category'], $_POST['store'])) {
        $_SESSION['product'] = [
            'id' => $_POST['id'],
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'image' => $_POST['image'],
            'category' => $_POST['category'],
            'store' => $_POST['store'],
        ];
    }
}



        $category = $_SESSION['product']['category'];
        $store = $_SESSION['product']['store'];

    // Get the other two stores manually
    if ($store === 'Makro') {
        $store1 = 'Dia';
        $store2 = 'Carrefour';
    } elseif ($store === 'Dia') {
        $store1 = 'Makro';
        $store2 = 'Carrefour';
    } else {
        $store1 = 'Makro';
        $store2 = 'Dia';
    }

    $stmt1 = $pdo->prepare("
        SELECT id, title, description,  price, image, store 
        FROM products
        WHERE category = ? AND store = ?
        ORDER BY RAND()
        LIMIT 1
    ");
    $stmt1->execute([$category, $store1]);
    $product1 = $stmt1->fetch(PDO::FETCH_ASSOC);

    $stmt2 = $pdo->prepare("
        SELECT id, title, description, price, image, store 
        FROM products
        WHERE category = ? AND store = ?
        ORDER BY RAND()
        LIMIT 1
    ");
    $stmt2->execute([$category, $store2]);
    $product2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Flash Market</title>
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/producto.css" />
</head>
<body>
  <div class="container">
  <header>
    <div class="top-bar">
          <a href="../main.php" class="logo">
            <img src="../logos/logo.png" alt="Flash Market Logo" class="logo" />
          </a>

          <input type="text" placeholder="Búsqueda..." class="search-bar" />
          <button class="search-btn">
            <img src="../logos/lupa.png" alt="" width="10" height="10">
          </button>

          <div class="icon-row">
            <button class="icon-btn" onclick="obtenerUbicacion()">
              <img src="../logos/ubicacion.png" alt="Ubicación" />
              <p id="resultado"></p>
            </button>

            <button id="currency-btn" class="icon-btn">
              <img src="../logos/divisa.png" alt="Moneda" />
              <span id="currency-label">EUR</span>
            </button>

            <button class="icon-btn" onclick="window.location.href='lista.php'">
              <img src="../logos/lista.png" alt="Favoritos" />
              <span>Lista y Favoritos</span>
            </button>

            <div class="icon-btn user-dropdown" id="userMenuToggle">
              <img src="../logos/usuario.png" alt="Usuario" />
              <span id="userGreeting">Bienvenido</span>
              <div class="dropdown-user hidden" id="userDropdown">
                <!-- Por defecto (sesión cerrada) -->
                <a href="html/login.php" id="loginBtn">Iniciar sesión</a>
                <a href="html/register.php" id="registerBtn">Registrarse</a>

                <!-- Cuando inicia sesión -->
                <a href="html/perfil.php" class="auth-only hidden">Mi perfil</a>
                <a href="html/admin.php" class="auth-only hidden">Admin</a>
                <a href="html/envios.php" class="auth-only hidden">Envíos</a>
                <a href="html/logout.php" id="logoutBtn" class="auth-only hidden">Cerrar sesión</a>
              </div>
            </div>

            <a href="cesta.php" class="icon-btn">
              <img src="../logos/carrito.png" alt="Carrito" />
            </a>
          </div>
        </div>

    <nav class="nav-bar">
      <button class="menu-btn">CATEGORÍAS</button>
        <a href="#">Charcutería y quesos</a>
        <a href="#">Carnicería</a>
        <a href="#">Pescados y mariscos</a>
        <a href="#">Verduras</a>
        <a href="#">Frutas</a>
        <a href="#">Lácteos</a>
        <a href="#">Yogures y postres</a>
        <a href="#">Arroz, pastas y legumbres</a>
    
      <!-- Menú desplegable oculto inicialmente -->
      <div id="category-dropdown" class="dropdown hidden">
        <a href="#">Aceites, salsas y especias</a>
        <a href="#">Conservas, caldos y cremas</a>
        <a href="#">Panes, harinas y masas</a>
        <a href="#">Café, cacao e infusiones</a>
        <a href="#">Azúcar, chocolates y caramelos</a>
        <a href="#">Galletas, bollos y cereales</a>
        <a href="#">Patatas fritas, encurtidos y frutos secos</a>
        <a href="#">Pizzas y platos preparados</a>
        <a href="#">Congelados</a>
        <a href="#">Agua, refrescos y zumos</a>
        <a href="#">Cervezas, vinos y bebidas alcoholicas</a>
        <a href="#">Limpieza y hogar</a>
      </div>
    </nav>
  </header>

  <main class="product-page">
    <div class="product-content">
    <!-- Foto y detalles principales -->
    <div class="product-photo">
    <img src="<?= htmlspecialchars($_SESSION['product']['image'] ?? '') ?>" alt="Foto del Producto" />
</div>

<div class="product-details">
    <h1><?= htmlspecialchars($_SESSION['product']['title'] ?? '') ?></h1>
    <p><?= htmlspecialchars($_SESSION['product']['description'] ?? '') ?></p>
</div>


    <!-- Precio principal y botón -->
    <aside class="product-price-box">
        <p class="price-label">Precio</p>
        <p class="product-price-main">
            <span class="product-price"><?= htmlspecialchars($_SESSION['product']['price'] ?? '') ?></span>
        </p>

          <input type="hidden" name="add_to_cart" value="1">
          <div>
          <div class="product" 
            data-id="<?= htmlspecialchars($_SESSION['product']['id']) ?>" 
            data-name="<?= htmlspecialchars($_SESSION['product']['title']) ?>" 
            data-price="<?= htmlspecialchars($_SESSION['product']['price']) ?>" 
            data-img="<?= htmlspecialchars($_SESSION['product']['image']) ?>" 
            style="display: none;">
          </div>
          <button type="submit" class="add-to-cart">Añadir al Carrito</button>
          
    </aside>
</div>

    <!-- Tiendas que ofrecen este producto -->
    <div class="store-list-visual">
      <!-- Ejemplo 1 -->
<!-- Print one product from each other store -->
<?php foreach ([$product1, $product2] as $product): ?>
    <?php if (!empty($product)): ?>
        <form method="post" action="producto.php" style="display: inline;">
  <!-- Hidden inputs to send product data -->
  <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
  <input type="hidden" name="title" value="<?= htmlspecialchars($product['title']) ?>">
  <input type="hidden" name="description" value="<?= htmlspecialchars($product['description'] ?? '') ?>">
  <input type="hidden" name="price" value="<?= htmlspecialchars($product['price']) ?>">
  <input type="hidden" name="image" value="<?= htmlspecialchars($product['image']) ?>">
  <input type="hidden" name="category" value="<?= htmlspecialchars($product['category'] ?? $_SESSION['product']['category']) ?>">
  <input type="hidden" name="store" value="<?= htmlspecialchars($product['store']) ?>">

  <!-- Styled like a div, behaves like a button -->
  <button type="submit" style="all: unset; width: 100%; cursor: pointer;">
    <div class="store-row" data-price="<?= htmlspecialchars($product['price']) ?>">
      <img src="<?= htmlspecialchars($product['image']) ?>" alt="Foto" />
      <div class="store-info">
        <div class="product-name"><?= htmlspecialchars($product['title']) ?></div>
        <div class="store-name"><?= htmlspecialchars($product['store']) ?></div>
      </div>
      <div class="store-price"><?= htmlspecialchars($product['price']) ?></div>
    </div>
  </button>
    <?php endif; ?>
<?php endforeach; ?>

  </main>

  <footer class="footer">
        <div class="footer-container">
          <div class="footer-section">
            <h3>Flash Market</h3>
            <p>Tu plataforma de confianza para encontrar lo que necesitas al mejor precio.</p>
          </div>
          <div class="footer-section">
            <h4>Enlaces útiles</h4>
            <ul>
              <li><a href="../main.php">Inicio</a></li>
              <li><a href="lista.php">Lista de Favoritos</a></li>
              <li><a href="terminos.php">Términos y Condiciones</a></li>
              <li><a href="politica.php">Política de Privacidad</a></li>
            </ul>
          </div>
          <div class="footer-section">
            <h4>Contacto</h4>
            <p>Email: soporte@flashmarket.com</p>
            <p>Tel: +34 600 123 456</p>
          </div>
        </div>
        <div class="footer-bottom">
          <p>&copy; 2025 Flash Market. Todos los derechos reservados.</p>
        </div>
      </footer>
    </div>
    <div id="search-modal" class="modal hidden">
      <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Resultado de búsqueda</h2>
        <div id="search-result-text">Buscando...</div>
      </div>
    <script>

    //cesta

    document.addEventListener('DOMContentLoaded', function () {
    const addToCartBtn = document.querySelector('.add-to-cart');
    const productElement = document.querySelector('.product');

    addToCartBtn.addEventListener('click', function () {
      const productId = productElement.dataset.id;
      const product = {
        id: productId,
        name: productElement.dataset.name,
        price: productElement.dataset.price,
        img: productElement.dataset.img,
        quantity: 1
      };

      
      let cart = JSON.parse(localStorage.getItem('cart')) || [];

      
      const existingProduct = cart.find(item => item.id === productId);

      if (existingProduct) {
        
        existingProduct.quantity += 1;
      } else {
        
        cart.push(product);
      }

      
      localStorage.setItem('cart', JSON.stringify(cart));
      alert('Producto añadido al carrito');
      console.log('Cart updated:', cart);
    });
  });

    // Geolocalización
    function obtenerUbicacion() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
          const lat = position.coords.latitude;
          const lon = position.coords.longitude;

          // Enviar coordenadas al servidor PHP
          fetch(`scripts/get_postal_code.php?lat=${lat}&lon=${lon}`)
            .then(response => response.text())
            .then(data => {
              localStorage.setItem("codigoPostal", data); // Guardar
              document.getElementById("resultado").textContent = "Código Postal: " + data;
            })
            .catch(err => {
              document.getElementById("resultado").textContent = "Error obteniendo código postal.";
            });
        }, function(error) {
          document.getElementById("resultado").textContent = "Error de geolocalización: " + error.message;
        });
      } else {
        document.getElementById("resultado").textContent = "Tu navegador no soporta geolocalización.";
      }
    }

    //Búsqueda  
    const searchBar = document.querySelector('.search-bar');
    const searchBtn = document.querySelector('.search-btn');
    const modal = document.getElementById('search-modal');
    const closeBtn = document.querySelector('.close-btn');
    const resultContainer = document.getElementById('search-result-text');

    function mostrarResultados(query) {
      if (!query.trim()) return;

      fetch('buscador.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ search: query })
      })
      .then(response => response.text())
      .then(data => {
        resultContainer.innerHTML = data;
        modal.classList.remove('hidden');
      })
      .catch(err => {
        resultContainer.innerHTML = 'Error al buscar.';
        modal.classList.remove('hidden');
      });
    }

    // Botón lupa
    searchBtn.addEventListener('click', () => {
      mostrarResultados(searchBar.value);
    });

    // Tecla Enter
    searchBar.addEventListener('keypress', (e) => {
      if (e.key === 'Enter') {
        e.preventDefault();
        mostrarResultados(searchBar.value);
      }
    });

    // Cerrar modal
    closeBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
    });

    // Obtener parámetros de la URL
    const params = new URLSearchParams(window.location.search);
    const name = params.get('name');
    const price = params.get('price');
    const img = params.get('img');

    // Actualizar contenido dinámico
    if (name && price && img) {
      document.querySelector('.product-details h1').textContent = name;
      document.querySelector('.product-photo img').src = img;
      document.querySelector('.product-price').textContent = `€${parseFloat(price).toFixed(2)}`;
    }


  </script>
<script src="../scripts/script.js"></script>

    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit;
    }
    ?>
</body>
</html>