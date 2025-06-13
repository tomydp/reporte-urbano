<?php
require('db.php'); 
header('Content-Type: application/json');

try {
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar campos obligatorios
    if (!isset($_POST['category_id'], $_POST['title'], $_POST['description'], $_POST['address'])) {
        echo json_encode([
            'status' => 400,
            'error' => 'Faltan campos requeridos'
        ]);
        exit;
    }

    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $status = 'open'; // Estado por defecto

    // Insertar en la base de datos
    $stmt = $conexion->prepare("
        INSERT INTO reports (category_id, title, description, address, status)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([$category_id, $title, $description, $address, $status]);

    echo json_encode([
        'status' => 201,
        'message' => 'Reporte creado exitosamente'
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'status' => 500,
        'error' => $e->getMessage()
    ]);
}
?>