<?php
require('db.php');
header('Content-Type: application/json');

try {
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conexion->query("SELECT id, name FROM categories");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 200,
        'categories' => $categories
    ]);

} catch (PDOException $e) {
    echo json_encode([
        'status' => 500,
        'error' => $e->getMessage()
    ]);
}
?>
