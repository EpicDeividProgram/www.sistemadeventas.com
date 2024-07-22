<?php


include('../../config.php');
global $pdo;
global $URL;

$rol = $_POST['rol'];
$id_rol = $_POST['id_rol'];
$fechahora = date('Y-m-d H:i:s'); // Asumo que quieres actualizar con la fecha y hora actual


        $sentencia = $pdo->prepare("UPDATE tb_roles 
        SET rol=:rol,
        fyh_actualizacion=:fyh_actualizacion 
        WHERE id_rol = :id_rol");
        $sentencia->bindParam(':rol', $rol);
        $sentencia->bindParam(':fyh_actualizacion', $fechahora);
        $sentencia->bindParam(':id_rol', $id_rol);
        $sentencia->execute();

        if ($sentencia->execute()){
            session_start();
            $_SESSION['mensaje'] = "Se actualizó al Rol correctamente";
            header('Location: ' . $URL . '/roles');
        }else{
            session_start();
            $_SESSION['mensaje'] = "Error: No se pudo actualizar en la base de datos";
            header('Location: ' . $URL . '/roles/update.php?id=' . $id_rol);
        }



