<?php
require('db.php'); // Tu archivo de conexión
header('Content-Type: application/json');

try {
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar que se haya enviado el nombre
    if (!isset($_POST['name']) || empty(trim($_POST['name']))) {
        echo json_encode([
            'status' => 400,
            'error' => 'El campo name es obligatorio'
        ]);
        exit;
    }

    $name = trim($_POST['name']);

    // Insertar la categoría
    $stmt = $conexion->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->execute([$name]);

    echo json_encode([
        'status' => 201,
        'message' => 'Categoría creada exitosamente'
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'status' => 500,
        'error' => $e->getMessage()
    ]);
}
?>
