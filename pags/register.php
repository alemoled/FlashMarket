<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="form_styles.css">
    <link rel="stylesheet" href="../css/relog.css">

</head>
<body>
    <div class="form-container">
        <h2>Crear Nueva Cuenta</h2>
        <form action="procesar_registro.php" method="POST">
            <div class="form-group">
                <label for="nombre_usuario">Nombre de Usuario:</label>
                <input type="text" id="nombre_usuario" name="nombre_usuario" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="submit-button">Crear Cuenta</button>
            <div class="form-navigation">
                <a href="login.php">¿Ya tienes una cuenta? Iniciar Sesión</a>
            </div>
        </form>
    </div>
</body>
</html>