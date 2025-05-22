<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos</title>
    <link rel="stylesheet" href="../css/pedidos.css">
</head>
<body>
    <header class="main-header">
        <div class="logo">Flash Market</div>
        <div class="user-info">
            <div class="name">Apellido, Nombre</div>
        </div>
       
    </header>
    <div class="container">
        <aside class="sidebar">
        <div class="user-info-sidebar">
            <div class="name">Apellido, Nombre</div>
            <div class="status online">Online</div>
        </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#">INICIO</a></li>
                    <li><a href="#">Sección 1</a></li>
                    <li><a href="#">Sección 2</a></li>
                    <li><a href="#">Sección 3</a></li>
                    <li><a href="#">Sección 4</a></li>
                </ul>
            </nav>
            <div class="logout">
                <a href="logout.php">Log out</a>
            </div>
        </aside>
        <main class="main-content">
            <h2 class="page-title">Lista de Pedidos</h2>
            <div class="order-list-container">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pedido</th>
                            <th>Categoría</th>
                            <th>Unidades</th>
                            <th>Dirección</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><button class="accept-button">Aceptar</button></td>
                        </tr>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td><button class="accept-button">Aceptar</button></td>
                        </tr>
                        </tbody>
                </table>
                <div class="pagination">
                    <button>&lt;&lt;</button>
                    <span class="current-page">1</span>
                    <button>&gt;&gt;</button>
                </div>
            </div>
        </main>
    </div>
</body>
</html>