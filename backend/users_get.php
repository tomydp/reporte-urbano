<?php
require ('db.php');
header('Content-Type: application/json');

try {
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $smtm= $conexion->prepare("SELECT * FROM users");
    $smtm->execute();

    $users = $smtm->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($users);

    
} catch (PDOException $e) {
    echo json_encode(array('error' => 'Error al obtener los usuarios: ' . $e->getMessage()));
}