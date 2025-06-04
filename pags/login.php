<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="form_styles.css">
    <link rel="stylesheet" href="../css/relog.css">
</head>
<body>
    <div class="form-container">
        <h2>Iniciar Sesión</h2>
        <form action="procesar_login.php" method="POST">
            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario o Correo Electrónico:</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="submit-button">Iniciar Sesión</button>
            <div class="form-navigation">
                <a href="register.php">¿No tienes una cuenta? Crear una</a>
            </div>
        </form>
    </div>
</body>
</html>