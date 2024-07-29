<?php
include ('../../config.php');

$nro_venta = $_POST['nro_venta'];
$id_cliente = $_POST['id_cliente'];
$total_a_cancelar = $_POST['total_a_cancelar'];
$fechahora = date('Y-m-d H:i:s');

try {
    $pdo->beginTransaction();

    $sentencia = $pdo->prepare("INSERT INTO tb_ventas (nro_venta, id_cliente, total_pagado, fyh_creacion) 
                                                    VALUES (:nro_venta, :id_cliente, :total_pagado, :fyh_creacion)");

    $sentencia->bindParam(':nro_venta', $nro_venta);
    $sentencia->bindParam(':id_cliente', $id_cliente);
    $sentencia->bindParam(':total_pagado', $total_a_cancelar);
    $sentencia->bindParam(':fyh_creacion', $fechahora);

    if($sentencia->execute()) {
        $pdo->commit();

        session_start();
        $_SESSION['mensaje'] = "Se registró la venta de manera correcta";
        echo '<script>location.href = "'.$URL.'/ventas/create.php";</script>';
    } else {
        throw new Exception("Error al registrar la venta");
    }
} catch (Exception $e) {
    $pdo->rollBack();
    session_start();
    $_SESSION['mensaje'] = "Error: no se pudo registrar en la base de datos";
    echo '<script>location.href = "'.$URL.'/ventas/create.php";</script>';
}
?>

