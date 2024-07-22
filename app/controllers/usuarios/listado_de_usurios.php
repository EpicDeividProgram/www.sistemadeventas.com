<?php

global$pdo;

$sql_usuarios = "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.email as email, us.telefono, us.cedula, us.fyh_creacion, rol.rol 
                 FROM tb_usuarios as us 
                 INNER JOIN tb_roles as rol ON us.id_rol = rol.id_rol";
$query_usuarios = $pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);