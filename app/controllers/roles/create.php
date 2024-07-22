<?php
include ('../../config.php');
global $pdo;
global $URL;

$nombre_rol = $_POST['rol'];
$fechahora = date('Y-m-d H:i:s'); // Asignar la fecha y hora actuales a la variable $fechahora

$sentencia = $pdo->prepare("INSERT INTO tb_roles (rol, fyh_creacion) VALUES (:rol, :fyh_creacion)");
$sentencia->bindParam(':rol', $nombre_rol);
$sentencia->bindParam(':fyh_creacion', $fechahora);

if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se registró un nuevo rol correctamente";
    header('Location: ' . $URL . '/roles');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: no se pudo registrar en la base de datos";
    header('Location: ' . $URL . '/roles/create.php');
}
