<?php
include ('../../config.php');

$nro_venta = $_POST['nro_venta'];
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];
$fechahora = date('Y-m-d H:i:s');

try {
    $sentencia = $pdo->prepare("INSERT INTO tb_carrito (nro_venta, id_producto, cantidad, fyh_creacion) 
    VALUES (:nro_venta, :id_producto, :cantidad, :fyh_creacion)");

    $sentencia->bindParam(':nro_venta', $nro_venta);
    $sentencia->bindParam(':id_producto', $id_producto);
    $sentencia->bindParam(':cantidad', $cantidad);
    $sentencia->bindParam(':fyh_creacion', $fechahora);

    if($sentencia->execute()) {
        echo '<script>location.href = "'.$URL.'/ventas/create.php";</script>';
    } else {
        session_start();
        $_SESSION['mensaje'] = "Error: No se pudo registrar en el carrito.";
        $_SESSION['icono'] = "error";
        echo '<script>location.href = "'.$URL.'/ventas/create.php";</script>';
    }
} catch (Exception $e) {
    session_start();
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    echo '<script>location.href = "'.$URL.'/ventas/create.php";</script>';
}
?>
