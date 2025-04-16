<?php
session_start();

// Ya estás logueado, ¿para qué perder tiempo? Redirigiendo a main.php 😎
if (isset($_SESSION['username'])) {
    header('Location: main.php');
    exit;
}

require 'api.php';

// Proceso de envío de formulario
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = $_POST['identifier'] ?? '';  // El identificador puede ser tu username o tu email, ¡decide tú!
    $password = $_POST['password'] ?? '';  // La clave secreta, que no se olvida 💣

    // Llamamos a la API para verificar que eres tú, que no vayas a hacerle trampa al sistema
    $response = handleRequest([
        'action' => 'login',
        'identifier' => $identifier,
        'password' => $password,
        'type' => 'user'  // Siempre serás un user... por ahora 🤖
    ]);

    // Si todo sale bien, nos guardamos tu username en sesión y te mandamos a main.php
    if ($response['status'] === 'success' && isset($response['user'])) {
        $_SESSION['username'] = $response['user']['username'];  // El username es lo único que importa ahora 💯
        header('Location: main.php');  // Te llevamos al lugar cool
        exit;
    } else {
        $error = $response['message'];  // Si algo sale mal, lo decimos sin pelos en la lengua 🧐
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<?php if ($error): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>  <!-- Si hay error, te lo mostramos con color para que no se te pase -->
<?php endif; ?>
<form method="POST" action="login.php">
    <label for="identifier">Username o Email:</label><br>
    <input type="text" id="identifier" name="identifier" required><br><br> <!-- Aquí pones tu username o tu correo, ¡tú decides! -->

    <label for="password">Contraseña:</label><br>
    <input type="password" id="password" name="password" required><br><br> <!-- La contraseña, esa cosa secreta que todos olvidamos a veces 😅 -->

    <button type="submit">Log In</button>  <!-- Botón para entrar al reino del login -->
</form>
</body>
</html>
