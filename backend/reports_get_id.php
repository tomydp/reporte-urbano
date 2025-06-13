<?php
require('db.php');
header('Content-Type: application/json');

try {
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar que el ID fue enviado
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        echo json_encode([
            'status' => 400,
            'error' => 'El parámetro id es obligatorio'
        ]);
        exit;
    }

    $id = $_GET['id'];

    // Consulta con LEFT JOIN
    $stmt = $conexion->prepare("
        SELECT 
            r.id, 
            r.title, 
            r.description, 
            r.address, 
            r.status, 
            c.name AS category
        FROM reports r
        LEFT JOIN categories c ON r.category_id = c.id
        WHERE r.id = ?
    ");
    $stmt->execute([$id]);
    $report = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($report) {
        echo json_encode([
            'status' => 200,
            'report' => $report
        ]);
    } else {
        echo json_encode([
            'status' => 404,
            'error' => 'Reporte no encontrado'
        ]);
    }

} catch (PDOException $e) {
    echo json_encode([
        'status' => 500,
        'error' => $e->getMessage()
    ]);
}
?>
