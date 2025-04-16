<?php

if ($_SERVER['PHP_SELF'] === '/api.php') {
    die('¡Acceso denegado!');  // No dejes que nadie entre directamente a este archivo, no es cool
}

// Cambiar nombres de la base de datos, pls no dejes todo hardcodeado 🙄
function dbConnect() {
    return new PDO('mysql:host=localhost;dbname=your_db;charset=utf8mb4', 'your_user', 'your_pass', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}

function handleRequest($data) {
    if (!isset($data['action'])) {
        return ['status' => 'error', 'message' => 'A ver, ¿qué acción quieres hacer?'];
    }

    switch ($data['action']) {
        case 'signup':
            return handleSignup($data);  // Llamamos al super método para registrarte 📝
        case 'login':
            return handleLogin($data);  // Entrando como un boss 👑
        default:
            return ['status' => 'error', 'message' => 'Acción desconocida, ¿qué estás haciendo?'];
    }
}

function handleSignup($data) {
    if (!isset($data['username'], $data['email'], $data['password'], $data['type'])) {
        return ['status' => 'error', 'message' => '¡Oye! Falta info importante, revisa los datos.'];
    }

    $pdo = dbConnect();  // Conectamos con la base de datos porque necesitamos chisme 🖥️

    // Verificamos si el username o el email ya existen, porque no queremos duplicados 😉
    $stmt = $pdo->prepare("SELECT username FROM USERS WHERE username = :username OR email = :email");
    $stmt->execute([
        ':username' => $data['username'],
        ':email' => $data['email']
    ]);

    if ($stmt->fetch()) {
        return ['status' => 'error', 'message' => 'El usuario o el email ya existe. ¿Quieres hacer trampa?'];
    }

    // ¡Ahora sí! Vamos a hacer un hash de la contraseña para que no sea tan fácil hackearnos 💥
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

    // Insertamos al nuevo usuario, tipo 'user' o el que sea. No le decimos "NO" a nadie. 
    $stmt = $pdo->prepare("INSERT INTO USERS (username, email, password, type) VALUES (:username, :email, :password, :type)");
    $stmt->execute([
        ':username' => $data['username'],
        ':email' => $data['email'],
        ':password' => $hashedPassword,
        ':type' => $data['type']  // Es importante enviar el tipo, sea user o algo más 🧑‍💻
    ]);

    return ['status' => 'success', 'message' => '¡Listo! El usuario fue registrado como un pro.'];
}

function handleLogin($data) {
    if (!isset($data['identifier'], $data['password'])) {
        return ['status' => 'error', 'message' => 'Bro, ¿dónde está tu username y/o contraseña?'];
    }

    $pdo = dbConnect();  // Necesitamos conectar para verificar el login, no hay forma de hacerlo sin magia 🪄

    // Buscamos al usuario, puede ser por username o por email, tú decides qué usar 🙃
    $stmt = $pdo->prepare("SELECT * FROM USERS WHERE username = :id OR email = :id LIMIT 1");
    $stmt->execute([':id' => $data['identifier']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($data['password'], $user['password'])) {
        return ['status' => 'error', 'message' => 'Credenciales inválidas, ¿seguro que recuerdas tu contraseña? 🤔'];
    }

    // Si todo está chill, retornamos solo el username, porque ya somos #friends
    return [
        'status' => 'success',
        'message' => 'Login exitoso, welcome back! 😎',
        'user' => [
            'username' => $user['username']  // Todo para ti, username, el rey 👑
        ]
    ];
}
