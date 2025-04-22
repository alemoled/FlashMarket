<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

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
