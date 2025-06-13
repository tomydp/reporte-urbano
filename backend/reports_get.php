<?php
require 'db.php';
header('Content-Type: application/json');

try{
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $smtm= $conexion->prepare("SELECT * FROM reports");
    $smtm->execute();

    $reports = $smtm->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($reports);

}catch(PDOException $e){
    echo json_encode(array('error' => 'Error al obtener los reportes: ' . $e->getMessage()));
}