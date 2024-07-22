<?php

include ('../../config.php');
global $pdo;
global $URL;

$nombre_categoria = $_GET['nombre_categoria'];
$fechahora = date('Y-m-d H:i:s'); // Asignar la fecha y hora actuales a la variable $fechahora

$sentencia = $pdo->prepare("INSERT INTO tb_categorias (nombre_categoria, fyh_creacion) VALUES (:nombre_categoria, :fyh_creacion)");
$sentencia->bindParam(':nombre_categoria', $nombre_categoria);
$sentencia->bindParam(':fyh_creacion', $fechahora);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se registró un nueva categoria correctamente";
    //header('Location: ' . $URL . '/categorias');
    echo "<script>location.href = '$URL/categorias';</script>";
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: no se pudo registrar en la base de datos";
    echo "<script>location.href = '$URL/categorias';</script>";
}