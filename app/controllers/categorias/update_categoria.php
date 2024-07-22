<?php
include('../../config.php');
global $pdo;
global $URL;

$nombre_categoria = $_GET['nombre_categoria'];
$id_categoria = $_GET['id_categoria'];
$fechahora = date('Y-m-d H:i:s'); // Asumo que quieres actualizar con la fecha y hora actual


$sentencia = $pdo->prepare("UPDATE tb_categorias 
        SET nombre_categoria=:nombre_categoria,
        fyh_actualizacion=:fyh_actualizacion 
        WHERE id_categoria = :id_categoria");
$sentencia->bindParam(':nombre_categoria', $nombre_categoria);
$sentencia->bindParam(':fyh_actualizacion', $fechahora);
$sentencia->bindParam(':id_categoria', $id_categoria);
$sentencia->execute();

if ($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se actualizó la categoria correctamente";
    //header('Location: ' . $URL . '/roles');
    echo "<script>location.href = '$URL/categorias';</script>";
}else{
    session_start();
    $_SESSION['mensaje'] = "Error: No se pudo actualizar en la base de datos";
    //header('Location: ' . $URL . '/roles/update.php?id=' . $id_rol);
    echo "<script>location.href = '$URL/categorias';</script>";
}

