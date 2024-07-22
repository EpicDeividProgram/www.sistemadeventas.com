<?php
global$pdo;

$sql_productos ="SELECT 
                        a.id_producto as id_producto, 
                        a.codigo as codigo, 
                        a.nombre as nombre, 
                        a.descripcion as descripcion, 
                        a.stock as stock,
                        a.stock_minimo as stock_minimo, 
                        a.stock_maximo as stock_maximo, 
                        a.precio_compra as precio_compra,
                        a.precio_venta as precio_venta, 
                        a.fecha_ingreso as fecha_ingreso, 
                        a.imagen as imagen, 
                        cat.nombre_categoria, u.email as email
                    FROM 
                        tb_almacen as a 
                    INNER JOIN 
                        tb_categorias as cat 
                    ON 
                        a.id_categoria = cat.id_categoria  INNER JOIN tb_usuarios as u On u.id_usuario = a.id_usuario";
$query_productos = $pdo->prepare($sql_productos);
$query_productos->execute();
$productos_datos = $query_productos->fetchAll(PDO::FETCH_ASSOC);