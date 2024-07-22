<?php
include ('../../config.php');
global $pdo;
global $URL;

$nombres = $_POST['nombres'];
$telefono = $_POST['telefono'];
$cedula = $_POST['cedula'];
$email = $_POST['email'];
$id_rol = $_POST['id_rol'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
$id_usuario = $_POST['id_usuario'];
$fechahora = date('Y-m-d H:i:s'); // Asumo que quieres actualizar con la fecha y hora actual

if ($password_user == ""){
    if ($password_user == $password_repeat) {
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE tb_usuarios 
    SET nombres=:nombres,
        telefono=:telefono,
        cedula=:cedula,
        email=:email,
        id_rol=:id_rol,
        fyh_actualizacion=:fyh_actualizacion 
    WHERE id_usuario = :id_usuario");

        $sentencia->bindParam(':nombres', $nombres);
        $sentencia->bindParam(':telefono', $telefono);
        $sentencia->bindParam(':cedula', $cedula);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':id_rol', $id_rol);
        $sentencia->bindParam(':fyh_actualizacion', $fechahora);
        $sentencia->bindParam(':id_usuario', $id_usuario);
        $sentencia->execute();

        session_start();
        $_SESSION['mensaje'] = "Se actualizó al usuario correctamente";
        header('Location: '.$URL.'/usuarios');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error: las contraseñas no son iguales";
        header('Location: '.$URL.'/usuarios/update.php?id='.$id_usuario);
    }
}else{
    if ($password_user == $password_repeat) {
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE tb_usuarios 
    SET nombres=:nombres,
        telefono=:telefono,
        cedula=:cedula,
        email=:email,
        id_rol=:id_rol,
        password_user=:password_user,
        fyh_actualizacion=:fyh_actualizacion 
    WHERE id_usuario = :id_usuario");

        $sentencia->bindParam(':nombres', $nombres);
        $sentencia->bindParam(':telefono', $telefono);
        $sentencia->bindParam(':cedula', $cedula);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':id_rol', $id_rol);
        $sentencia->bindParam(':password_user', $password_user);
        $sentencia->bindParam(':fyh_actualizacion', $fechahora);
        $sentencia->bindParam(':id_usuario', $id_usuario);
        $sentencia->execute();

        session_start();
        $_SESSION['mensaje'] = "Se actualizó al usuario correctamente";
        header('Location: '.$URL.'/usuarios');
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error: las contraseñas no son iguales";
        header('Location: '.$URL.'/usuarios/update.php?id='.$id_usuario);
    }
}


