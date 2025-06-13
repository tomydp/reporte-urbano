<?php
require('db.php'); // tu archivo de conexión a la base
header('Content-Type: application/json');

try {
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validar datos requeridos
    if (!isset($_POST['name'], $_POST['email'], $_POST['password'])) {
        echo json_encode([
            'status' => '400',
            'error' => 'Faltan campos obligatorios'
        ]);
        exit;
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar si el email ya está registrado
    $verificar = $conexion->prepare("SELECT id FROM users WHERE email = ?");
    $verificar->execute([$email]);

    if ($verificar->rowCount() > 0) {
        echo json_encode([
            'status' => '409',
            'error' => 'El correo ya está registrado'
        ]);
        exit;
    }

    // Encriptar la contraseña
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario (no admin, activo)
    $stmt = $conexion->prepare("INSERT INTO users (name, email, password, admin, status) VALUES (?, ?, ?, 0, 1)");
    $stmt->execute([$name, $email, $hashed]);

    echo json_encode([
        'status' => '201',
        'message' => 'Usuario registrado correctamente'
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'status' => '500',
        'error' => $e->getMessage()
    ]);
}
