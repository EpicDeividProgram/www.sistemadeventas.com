<?php
include ('../../config.php');
global $pdo;
global $URL;

$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];

$imagen = $_POST['image'];

$nombreDelArchivo = date("Y-m-d-h-i-s");
$filename = $nombreDelArchivo."__".$_FILES['image']['name'];
$location = "../../../almacen/img-productos/".$filename;
$fechahora = date('Y-m-d H:i:s'); // Asegúrate de inicializar $fechahora

move_uploaded_file($_FILES['image']['tmp_name'],$location);


$sentencia = $pdo->prepare("INSERT INTO tb_almacen (codigo, id_categoria, nombre, id_usuario, descripcion, stock, stock_minimo, stock_maximo, precio_compra, precio_venta, fecha_ingreso, imagen, fyh_creacion) 
                            VALUES (:codigo, :id_categoria, :nombre, :id_usuario, :descripcion, :stock, :stock_minimo, :stock_maximo, :precio_compra, :precio_venta, :fecha_ingreso, :imagen, :fyh_creacion)");
$sentencia->bindParam(':codigo', $codigo);
$sentencia->bindParam(':id_categoria', $id_categoria);
$sentencia->bindParam(':nombre', $nombre);
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->bindParam(':descripcion', $descripcion);
$sentencia->bindParam(':stock', $stock);
$sentencia->bindParam(':stock_minimo', $stock_minimo);
$sentencia->bindParam(':stock_maximo', $stock_maximo);
$sentencia->bindParam(':precio_compra', $precio_compra);
$sentencia->bindParam(':precio_venta', $precio_venta);
$sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam(':imagen', $filename);
$sentencia->bindParam(':fyh_creacion', $fechahora);


if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se registró un producto correctamente";
    header('Location: ' . $URL . '/almacen');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: no se pudo registrar en la base de datos";
    header('Location: ' . $URL . '/almacen/create.php');
}