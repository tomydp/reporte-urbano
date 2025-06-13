<?php
$conexion= new PDO('mysql:host=localhost;dbname=reportesurbanos', 'root', '1234');
if (!$conexion) {
    die("Connection failed: " . $conexion->errorInfo());
}else {
    echo "Connected successfully";
}
?>