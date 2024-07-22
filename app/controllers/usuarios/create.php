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
$fechahora = date('Y-m-d H:i:s'); // Asegúrate de inicializar $fechahora

if ($password_user == $password_repeat) {
    $password_user = password_hash($password_user, PASSWORD_DEFAULT);

    $sentencia = $pdo->prepare("INSERT INTO tb_usuarios (nombres, telefono, cedula, email, id_rol, password_user, fyh_creacion) VALUES (:nombres, :telefono, :cedula, :email, :id_rol, :password_user, :fyh_creacion)");
    $sentencia->bindParam(':nombres', $nombres);
    $sentencia->bindParam(':telefono', $telefono);
    $sentencia->bindParam(':cedula', $cedula);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':id_rol', $id_rol);
    $sentencia->bindParam(':password_user', $password_user);
    $sentencia->bindParam(':fyh_creacion', $fechahora);
    $sentencia->execute();

    session_start();
    $_SESSION['mensaje'] = "Se registró al usuario correctamente";
    header('Location: '.$URL.'/usuarios');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: las contraseñas no son iguales";
    header('Location: '.$URL.'/usuarios/create.php');
}
