<?php
include ('../../config.php');

$id_producto = $_POST['id_producto'];
$nro_compra = $_POST['nro_compra'];
$fecha_compra = $_POST['fecha_compra'];
$id_proveedor = $_POST['id_proveedor'];
$comprobante = $_POST['comprobante'];
$id_usuario = $_POST['id_usuario'];
$precio_compra = $_POST['precio_compra'];
$cantidad_compra = $_POST['cantidad_compra'];
$stock_total = $_POST['stock_total'];
$fechahora = date('Y-m-d H:i:s');

try {
    $pdo->beginTransaction();

    $sentencia = $pdo->prepare("INSERT INTO tb_compras (id_producto, nro_compra, fecha_compra, id_proveedor, comprobante, id_usuario, precio_compra, cantidad, fyh_creacion) 
    VALUES (:id_producto, :nro_compra, :fecha_compra, :id_proveedor, :comprobante, :id_usuario, :precio_compra, :cantidad, :fyh_creacion)");

    $sentencia->bindParam(':id_producto', $id_producto);
    $sentencia->bindParam(':nro_compra', $nro_compra);
    $sentencia->bindParam(':fecha_compra', $fecha_compra);
    $sentencia->bindParam(':id_proveedor', $id_proveedor);
    $sentencia->bindParam(':comprobante', $comprobante);
    $sentencia->bindParam(':id_usuario', $id_usuario);
    $sentencia->bindParam(':precio_compra', $precio_compra);
    $sentencia->bindParam(':cantidad', $cantidad_compra);
    $sentencia->bindParam(':fyh_creacion', $fechahora);

    if($sentencia->execute()) {
        $sentencia = $pdo->prepare("UPDATE tb_almacen SET stock=:stock WHERE id_producto = :id_producto ");
        $sentencia->bindParam(':stock', $stock_total);
        $sentencia->bindParam(':id_producto', $id_producto);
        $sentencia->execute();

        $pdo->commit();

        session_start();
        $_SESSION['mensaje'] = "Se registró la compra de manera correcta";
        $_SESSION['icono'] = "success";
        echo '<script>location.href = "'.$URL.'/compras";</script>';
    } else {
        throw new Exception("Error al registrar la compra");
    }
} catch (Exception $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error: " . $e->getMessage();
    $_SESSION['icono'] = "error";
    echo '<script>location.href = "'.$URL.'/compras/create.php";</script>';
}
?>

