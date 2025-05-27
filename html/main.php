<?php
session_start();

// Si no estás logueado, ¿a dónde vas? Te mandamos directo a login.php, para que no hagas trampa 😉
if (!isset($_SESSION['username'])) {
    header('Location: login.php');  // O mostramos un error, tú decides
    exit;
}

// Si todo está bien, bienvenido a tu mundo, "usuario famoso". ¡Tu username es lo más! 😎
echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";  // Aquí te damos la bienvenida con estilo, para que sepas que eres VIP
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <button type="submit" name="logout">Cerrar sesión</button>
    </form>

    <?php
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit;
    }
    ?>
</body>
</html>
