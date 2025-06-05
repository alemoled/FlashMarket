<?php
session_start();
require 'api.php';
$pdo = dbConnect();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $search = $_POST['search'];

    echo "<h2>Resultados para: " . htmlspecialchars($search) . "</h2>";

    // Use prepared statements for security
    $stmt = $pdo->prepare("SELECT * FROM products WHERE title LIKE :search OR description LIKE :search");
    $likeSearch = "%$search%";
    $stmt->bindParam(':search', $likeSearch, PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // if ($results) {
    //     foreach ($results as $row) {
    //         echo "<div class='product'>";
    //         echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
    //         echo "<p>" . htmlspecialchars($row['description']) . "</p>";
    //         echo "<p>Precio: $" . htmlspecialchars($row['price']) . "</p>";
    //         echo "</div>";
    //     }
    // } else {
    //     echo "<p>La búsqueda no encontró resultados.</p>";
    // }
    if ($results) {
    foreach ($results as $product) {
        echo '<form method="post" action="html/producto.php" style="display:inline;">';
        
        // Output hidden inputs for each product field
        foreach ($product as $key => $value) {
            echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
        }
        
        echo '<button type="submit" style="all: unset; cursor: pointer;">';
        
        echo '<div class="product" data-id="' . htmlspecialchars($product['id']) . '" data-name="' . htmlspecialchars($product['title']) . '" data-price="' . htmlspecialchars($product['price']) . '">';
        
        echo '<div class="product-img">';
        echo '<img src="' . htmlspecialchars($product['image']) . '" alt="Producto ' . htmlspecialchars($product['title']) . '" />';
        echo '</div>';
        
        echo '<div class="product-info">';
        echo '<span class="product-name">' . htmlspecialchars($product['title']) . '</span>';
        echo '<span>' . htmlspecialchars($product['price']) . '</span>';
        echo '</div>';
        
        echo '</div>';
        echo '</button>';
        echo '</form>';
    }
} else {
    echo "<p>La búsqueda no encontró resultados.</p>";
}

}
?>

<!-- 
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
</html> -->
