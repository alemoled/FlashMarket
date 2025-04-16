<?php
session_start();

// Si no estás logueado, ¿a dónde vas? Te mandamos directo a login.php, para que no hagas trampa 😉
if (!isset($_SESSION['username'])) {
    header('Location: login.php');  // O mostramos un error, tú decides
    exit;
}

// Si todo está bien, bienvenido a tu mundo, "usuario famoso". ¡Tu username es lo más! 😎
echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";  // Aquí te damos la bienvenida con estilo, para que sepas que eres VIP
