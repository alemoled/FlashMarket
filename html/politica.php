<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Politicas de Privacidad</title>
  <link rel="stylesheet" href="../css/main.css" />
  <link rel="stylesheet" href="../css/cesta.css" />
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
        <main>
      <section class="terms-section">
        <h1>Política de Privacidad</h1>
        <p>En Flash Market, valoramos tu privacidad y nos comprometemos a proteger tus datos personales.</p>

        <h2>1. Recopilación de Datos</h2>
        <p>Recopilamos información como nombre, dirección, correo electrónico y ubicación para mejorar tu experiencia de compra.</p>

        <h2>2. Uso de la Información</h2>
        <p>Utilizamos los datos únicamente para procesar pedidos, mejorar el servicio y enviar comunicaciones relevantes.</p>

        <h2>3. Seguridad</h2>
        <p>Implementamos medidas de seguridad para proteger tus datos contra accesos no autorizados.</p>

        <h2>4. Derechos del Usuario</h2>
        <p>Tienes derecho a acceder, corregir o eliminar tus datos personales. Contáctanos para ejercer estos derechos.</p>

        <p>Para cualquier duda, escríbenos a <a href="mailto:soporte@flashmarket.com">soporte@flashmarket.com</a>.</p>
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

    //cesta
const container = document.getElementById('cart-container');
    const totalContainer = document.getElementById('cart-total');

    function renderCart() {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      container.innerHTML = '';
      let total = 0;

      if (cart.length === 0) {
        container.innerHTML = '<p class="empty-message">Tu cesta está vacía.</p>';
        totalContainer.textContent = '';
        return;
      }

      cart.forEach(product => {
        total += product.price * product.quantity;

        const item = document.createElement('div');
        item.className = 'cart-item';
        item.innerHTML = `
          <img src="${product.img}" alt="${product.name}">
          <div class="cart-item-details">
            <strong>${product.name}</strong><br>
            Precio: €${product.price.toFixed(2)}<br>
            Cantidad: ${product.quantity}
          </div>
          <button class="remove-btn" data-id="${product.id}">Eliminar</button>
        `;
        container.appendChild(item);
      });

      totalContainer.textContent = `Total: €${total.toFixed(2)}`;

      document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
          const id = e.target.dataset.id;
          const updatedCart = cart.filter(item => item.id !== id);
          localStorage.setItem('cart', JSON.stringify(updatedCart));
          renderCart();
        });
      });
    }

    renderCart();

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