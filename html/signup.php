<?php
session_start();

// Si ya estás logueado, ¿para qué perder tiempo? Te mandamos directo a main.php 😎
if (isset($_SESSION['username'])) {
    header('Location: main.php');
    exit;
}

require 'api.php';

// Proceso de envío del formulario
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';  // ¡Tu nombre de usuario, el más cool!
    $email = $_POST['email'] ?? '';  // El email, por si decides olvidarte del username ✉️
    $password = $_POST['password'] ?? '';  // La contraseña, esa clave secreta que nunca compartimos (a menos que seas hacker 🤫)

    // Enviamos los datos a la API (siempre 'user' para el tipo, ya sabes, un signup normal)
    $response = handleRequest([
        'action' => 'signup',
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'type' => 'user'  // Si eres normal, tipo 'user', no hay sorpresa aquí 😉
    ]);

    // Si todo sale bien, nos guardamos tu username y te llevamos a main.php, ¡es hora de disfrutar!
    if ($response['status'] === 'success') {
        $_SESSION['username'] = $username;  // Guardamos tu username, porque eres nuestro VIP
        header('Location: main.php');  // Te llevamos directo a la acción
        exit;
    } else {
        // Si algo sale mal, te mostramos el error para que no te hagas el loco
        $error = $response['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
</head>
<body>
<h2>Signup</h2>
<?php if ($error): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>  <!-- Si hay un error, te lo decimos con todo el amor posible -->
<?php endif; ?>
<form method="POST" action="signup.php">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br> <!-- Nombre de usuario, tu primer paso para la fama 🌟 -->

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br> <!-- Tu email, para siempre estar en contacto 📧 -->

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br> <!-- ¡No olvides tu contraseña, por favor! 🗝️ -->

    <button type="submit">Sign Up</button>  <!-- El botón mágico que te llevará a otro nivel 🚀 -->
</form>
</body>
</html>
