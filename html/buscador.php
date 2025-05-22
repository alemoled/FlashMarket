<?php
session_start();
require '../php/conexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search = $conexion->real_escape_string($_POST['search']);

    echo "<h2>Resultados para: " . htmlspecialchars($search) . "</h2>";
    $result = $conexion->query("SELECT * FROM productos WHERE nombre LIKE '%$search%' OR descripcion LIKE '%$search%'");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<h3>" . htmlspecialchars($row['nombre']) . "</h3>";
            echo "<p>" . htmlspecialchars($row['descripcion']) . "</p>";
            echo "<p>Precio: $" . htmlspecialchars($row['precio']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>La búsqueda no encontró resultados.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador en Tiempo Real</title>
</head>
<body>
    <div id="searchCon">
        <input type="text" name="search" id="searchInput" placeholder="Buscar...">
    </div>
    <div id="resultSearch"></div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            let searchQuery = this.value;

            if (searchQuery.trim() !== '') {
                fetch(window.location.href, { 
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: new URLSearchParams({ search: searchQuery })
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('resultSearch').innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('resultSearch').innerHTML = ''; // Limpia los resultados si el campo está vacío
            }
        });
    </script>
</body>
</html>
