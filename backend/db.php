<?php
$conexion= new PDO('mysql:host=localhost;port=3307;dbname=reportesurbanos', 'root', '');
if (!$conexion) {
    die("Connection failed: " . $conexion->errorInfo());
}else {
    echo "Connected successfully";
}
?>