<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - FlashMarket</title>
    <link rel="stylesheet" href="../css/css.css">
    <style>
        .containerError {
            text-align: center;
            padding: 50px 20px;
            margin: 50px auto;
            max-width: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .titleError {
            color: #e74c3c;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .messageError {
            color: #333;
            margin-bottom: 30px;
        }
        .buttonBack {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .buttonBack:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    
    // Función para obtener el mensaje de error según el código
    function getErrorMessage($error) {
        $errorMessages = [
            '404' => 'La página que buscas no se encuentra.',
            '403' => 'No tienes permiso para acceder a esta página.',
            '500' => 'Error interno del servidor.',
            'db_connection' => 'Error de conexión a la base de datos.',
            'login_required' => 'Debes iniciar sesión para acceder a esta página.',
            'invalid_credentials' => 'Credenciales inválidas.',
            'default' => 'Ha ocurrido un error inesperado.'
        ];
        
        return isset($errorMessages[$error]) ? $errorMessages[$error] : $errorMessages['default'];
    }

    // Obtener el código de error de la URL
    $errorCode = isset($_GET['error']) ? $_GET['error'] : 'default';
    $errorMessage = getErrorMessage($errorCode);
    ?>

    <div class="containerError">
        <h1 class="titleError">¡Ups! Algo salió mal</h1>
        <p class="messageError"><?php echo htmlspecialchars($errorMessage); ?></p>
        <a href="../html/main.php" class="buttonBack">Volver al inicio</a>
    </div>
</body>
</html>