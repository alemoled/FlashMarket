<?php
session_start();

// Si ya estás logueado, ¿para qué perder tiempo? Te mandamos directo a main.php 😎
if (isset($_SESSION['username'])) {
    header('Location: ../main.php');
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
        header('Location: ../main.php');  // Te llevamos directo a la acción
        exit;
    } else {
        // Si algo sale mal, te mostramos el error para que no te hagas el loco
        $error = $response['message'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form_styles.css">
    <title>Signup</title>
    <link rel="stylesheet" href="../css/reloj.css"> <!-- Tu estilo, porque la vida es corta para no verse bien -->

</head>
<body>
    
    <div class="form-container">
        <h2>Registrarse</h2>
        <?php if ($error): ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>  <!-- Si hay un error, te lo decimos con todo el amor posible -->
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Nombre de usuario</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña </label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmar contraseña </label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit"  class="submit-button">Registrarse</button>  <!-- El botón mágico que te llevará a otro nivel 🚀 -->
            <div class="form-navigation">
                <a href="login.php">¿Ya tienes una cuenta? Iniciar Sesión</a>
            </div>
        </form>
    </div>
</body>
</html>