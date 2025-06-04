<?php
require 'html/API.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Flash Market</title>
  <link rel="stylesheet" href="css/main.css" />
</head>
  <body>
    <div class="container">
      <header>
        <div class="top-bar">
          <a href="main.php" class="logo">
            <img src="logos/logo.png" alt="Flash Market Logo" class="logo" />
          </a>
          <input type="text" placeholder="Búsqueda..." class="search-bar" />
          <button class="search-btn">
            <img src="logos/lupa.png" alt="" width="10" height="10">
          </button>

          <div class="icon-row">
            <button class="icon-btn" onclick="obtenerUbicacion()">
              <img src="logos/ubicacion.png" alt="Ubicación" />
              <span id="resultado"></span>
            </button>

            <button id="currency-btn" class="icon-btn">
              <img src="logos/divisa.png" alt="Moneda" />
              <span id="currency-label">EUR</span>
            </button>

            <button class="icon-btn" onclick="window.location.href='pags/lista.php'">
              <img src="logos/lista.png" alt="Favoritos" />
              <span>Lista y Favoritos</span>
            </button>

            <div class="icon-btn user-dropdown" id="userMenuToggle">
              <img src="logos/usuario.png" alt="Usuario" />
              <span id="userGreeting">Bienvenido</span>
              <div class="dropdown-user hidden" id="userDropdown">
                <!-- Por defecto (sesión cerrada) -->
                <a href="pags/login.php" id="loginBtn">Iniciar sesión</a>
                <a href="pags/register.php" id="registerBtn">Registrarse</a>

                <!-- Cuando inicia sesión -->
                <a href="pags/perfil.php" class="auth-only hidden">Mi perfil</a>
                <a href="pags/admin.php" class="auth-only hidden">Admin</a>
                <a href="pags/envios.php" class="auth-only hidden">Envíos</a>
                <a href="pags/logout.php" id="logoutBtn" class="auth-only hidden">Cerrar sesión</a>
              </div>
            </div>

            <a href="pags/cesta.php" class="icon-btn">
              <img src="logos/carrito.png" alt="Carrito" />
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

      <main>
        <section class="carousel">
          <div class="carousel-container">
            <img src="img/bannerDia.png" alt="Oferta 1" class="carousel-slide active" />
            <img src="img/bannerCarrefour.png" alt="Oferta 2" class="carousel-slide" />
            <img src="img/bannerMakro.png" alt="Oferta 3" class="carousel-slide" />
        
            <button class="carousel-btn prev">&#10094;</button>
            <button class="carousel-btn next">&#10095;</button>
          </div>
        </section>
        

        <section class="product-list">
          <div class="product-list">
            <div class="product" data-id="1" data-name="Producto 1" data-price="10" data-img="https://placehold.co/150" onclick="verProducto(this)">
              <div class="product-img">
                <img src="https://placehold.co/150" alt="Producto 1" />
              </div>
              <div class="product-info">
                <span class="product-name">Producto 1</span>
                <span class="product-price">€10.00</span>
              </div>
            </div>

            <div class="product" data-id="2" data-name="Producto 2" data-price="15" data-img="https://placehold.co/150" onclick="verProducto(this)">
              <div class="product-img">
                <img src="https://placehold.co/150" alt="Producto 2" />
              </div>
              <div class="product-info">
                <span class="product-name">Producto 2</span>
                <span class="product-price">€15.00</span>
              </div>
            </div>

            <div class="product" data-id="3" data-name="Producto 3" data-price="30" data-img="https://placehold.co/150" onclick="verProducto(this)">
              <div class="product-img">
                <img src="https://placehold.co/150" alt="Producto 3" />
              </div>
              <div class="product-info">
                <span class="product-name">Producto 3</span>
                <span class="product-price">€30.00</span>
              </div>
            </div>

            <div class="product" data-id="4" data-name="Producto 4" data-price="8" data-img="https://placehold.co/150" onclick="verProducto(this)">
              <div class="product-img">
                <img src="https://placehold.co/150" alt="Producto 4" />
              </div>
              <div class="product-info">
                <span class="product-name">Producto 4</span>
                <span class="product-price">€8.00</span>
              </div>
            </div>

            <div class="product" data-id="5" data-name="Producto 5" data-price="22" data-img="https://placehold.co/150" onclick="verProducto(this)">
              <div class="product-img">
                <img src="https://placehold.co/150" alt="Producto 5" />
              </div>
              <div class="product-info">
                <span class="product-name">Producto 5</span>
                <span class="product-price">€22.00</span>
              </div>
            </div>

            <div class="product" data-id="6" data-name="Producto 6" data-price="2.50" data-img="https://placehold.co/150" onclick="verProducto(this)">
              <div class="product-img">
                <img src="https://placehold.co/150" alt="Producto 6" />
              </div>
              <div class="product-info">
                <span class="product-name">Producto 6</span>
                <span class="product-price">€2.50</span>
              </div>
            </div>

            <div class="product" data-id="7" data-name="Producto 7" data-price="5.40" data-img="https://placehold.co/150" onclick="verProducto(this)">
              <div class="product-img">
                <img src="https://placehold.co/150" alt="Producto 7" />
              </div>
              <div class="product-info">
                <span class="product-name">Producto 7</span>
                <span class="product-price">€5.40</span>
              </div>
            </div>

            <div class="product" data-id="8" data-name="Producto 8" data-price="8" data-img="https://placehold.co/150" onclick="verProducto(this)">
              <div class="product-img">
                <img src="https://placehold.co/150" alt="Producto 8" />
              </div>
              <div class="product-info">
                <span class="product-name">Producto 8</span>
                <span class="product-price">€8.00</span>
              </div>
            </div>

            <div class="product" data-id="9" data-name="Producto 9" data-price="7.45" data-img="https://placehold.co/150" onclick="verProducto(this)">
              <div class="product-img">
                <img src="https://placehold.co/150" alt="Producto 9" />
              </div>
              <div class="product-info">
                <span class="product-name">Producto 7</span>
                <span class="product-price">€7.45</span>
              </div>
            </div>

            <div class="product" data-id="10" data-name="Producto 10" data-price="58" data-img="https://placehold.co/150" onclick="verProducto(this)">
              <div class="product-img">
                <img src="https://placehold.co/150" alt="Producto 10" />
              </div>
              <div class="product-info">
                <span class="product-name">Producto 8</span>
                <span class="product-price">€58.00</span>
              </div>
            </div>

          </div>   
        </section>
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
              <li><a href="main.php">Inicio</a></li>
              <li><a href="html/lista.php">Lista de Favoritos</a></li>
              <li><a href="html/terminos.php">Términos y Condiciones</a></li>
              <li><a href="html/politica.php">Política de Privacidad</a></li>
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
    </div>
    <script src="scripts/script.js"></script>
    <script>
      //carrusel
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-slide');
    const totalSlides = slides.length;

    const nextBtn = document.querySelector('.carousel-btn.next');
    const prevBtn = document.querySelector('.carousel-btn.prev');

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (i === index) slide.classList.add('active');
      });
    }

    function nextSlide() {
      currentSlide = (currentSlide + 1) % totalSlides;
      showSlide(currentSlide);
    }

    function prevSlide() {
      currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
      showSlide(currentSlide);
    }

    nextBtn.addEventListener('click', nextSlide);
    prevBtn.addEventListener('click', prevSlide);

    // Auto play
    setInterval(nextSlide, 5000); // cambia cada 5 segundos

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
      //OTRA VEZ LO DE LA API DE BUSCADOR
      fetch('scripts/buscar_productos.php', {
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

    // Ver producto
    function verProducto(element) {
    const name = encodeURIComponent(element.dataset.name);
    const price = encodeURIComponent(element.dataset.price);
    const img = encodeURIComponent(element.dataset.img);
    window.location.href = `html/producto.php?name=${name}&price=${price}&img=${img}`;
  }
  </script>
</div>
    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit;
    }
    ?>
</body>
</html>