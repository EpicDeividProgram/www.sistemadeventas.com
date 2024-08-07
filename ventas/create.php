<?php
include ('../app/config.php');
include ('../app/controllers/ventas/listado_de_ventas.php');
include ('../app/controllers/almacen/lista_de_productos.php');
include ('../app/controllers/clientes/lista_de_clientes.php');
global$pdo;
$URL = "http://localhost/www.sistemadeventas.com";
session_start();
if(isset($_SESSION['sesion_email'])){
    // echo "si existe sesion de ".$_SESSION['sesion_email'];
    $email_sesion = $_SESSION['sesion_email'];
    $sql = "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.email as email, rol.rol as rol 
                  FROM tb_usuarios as us INNER JOIN tb_roles as rol ON us.id_rol = rol.id_rol WHERE email='$email_sesion'";
    $query = $pdo->prepare($sql);
    $query->execute();
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usuarios as $usuario){
        $id_usuario_sesion = $usuario['id_usuario'];
        $nombres_sesion = $usuario['nombres'];
        $rol_sesion = $usuario['rol'];
    }
}else{
    echo "no existe sesion";
    header('Location: '.$URL.'/login');
}
?>
<!DOCTYPE html>

<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="e">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Ventas</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <!-- libreria SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>


</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">SISTEMA DE VENTAS</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?php echo $URL;?>" class="brand-link">
            <img src="<?php echo $URL;?>/public/images/tienda-online-icono-vectorial-aislado-sobre-fondo-transparente-transparencia-concepto-logotipo-tienda-online-r1r4t5-1.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">HOME</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?php echo $nombres_sesion?></a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="#" class="nav-link" style="background-color:#0275d7">
                            <i class="nav-icon fas fa-users" ></i>
                            <p>
                                Usuarios
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL?>/usuarios" class="nav-link">
                                    <i class="far fa-circle nav-icon fas fa-list"></i>
                                    <p>Listado de Usuarios</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $URL?>/usuarios/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Creacion de Usuarios</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="#" class="nav-link" style="background-color:#0275d7">
                            <i class="nav-icon fas fa-address-book" ></i>
                            <p>
                                Roles
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL?>/roles" class="nav-link">
                                    <i class="far fa-circle nav-icon fas fa-list"></i>
                                    <p>Listado de Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $URL?>/roles/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Creacion de Roles</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link" style="background-color:#0275d7">
                            <i class="nav-icon fas fa-boxes" ></i>
                            <p>
                                Almacen
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL?>/almacen" class="nav-link">
                                    <i class="far fa-circle nav-icon fas fa-list"></i>
                                    <p>Listado del Almacen</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $URL?>/almacen/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Creacion de productos</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link" style="background-color:#0275d7">
                            <i class="nav-icon fas fa-table" ></i>
                            <p>
                                Categorias
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL?>/categorias" class="nav-link">
                                    <i class="far fa-circle nav-icon fas fa-list"></i>
                                    <p>Listado del Categorias</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-car"></i>
                            <p>
                                Proveedores
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL;?>/proveedores" class="nav-link">
                                    <i class="far fa-circle nav-icon fas fa-list"></i>
                                    <p>Listado de proveedores</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-cart-plus"></i>
                            <p>
                                Compras
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL;?>/compras" class="nav-link">
                                    <i class="far fa-circle nav-icon fas fa-list"></i>
                                    <p>Listado de compras</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $URL;?>/compras/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Creación de compra</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item ">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>
                                Ventas
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL;?>/ventas" class="nav-link">
                                    <i class="far fa-circle nav-icon fas fa-list"></i>
                                    <p>Listado de ventas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $URL;?>/ventas/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Creación de ventas</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link" style="background-color:#0275d7">
                            <i class="nav-icon fas fa-user" ></i>
                            <p>
                                Clientes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL?>/clientes" class="nav-link">
                                    <i class="far fa-circle nav-icon fas fa-list"></i>
                                    <p>Listado de clientes</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="<?php echo $URL;?>/app/controllers/login/cerrar_sesion.php" class="nav-link" style="background-color: #8B4545">
                            <i class="nav-icon fas fa-door-closed"></i>
                            <p>
                                Cerrar Sesion

                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0">Ventas</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>


        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <?php
                                $contador_de_ventas = 0;
                                foreach ($ventas_datos as $ventas_dato){
                                    $contador_de_ventas = $contador_de_ventas + 1;
                                }
                                ?>
                                <h3 class="card-title"><i class="fa fa-shopping-bag"></i> nr de la venta <input type="text" style="text-align: center" value="<?php echo $contador_de_ventas + 1?>" disabled></h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>

                            </div>

                            <div class="card-body">
                                <b>Carrito</b>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-buscar_producto">
                                    <i class="fa fa-search"></i>
                                    Buscar producto
                                </button>
                                <!-- modal para visualizar datos de los productos -->
                                <div class="modal fade" id="modal-buscar_producto">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content modal-lg">
                                            <div class="modal-header" style="background-color: #07b0d6;color: white">
                                                <h4 class="modal-title">Busqueda del producto</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="example1" class="table table-bordered table-striped table-sm">
                                                            <thead>
                                                            <tr>
                                                                <th class="text-center">Nro</th>
                                                                <th class="text-center">Seleccionar</th>
                                                                <th class="text-center">Código Producto</th>
                                                                <th class="text-center">Categoría</th>
                                                                <th class="text-center">Nombre</th>
                                                                <th class="text-center">Imagen</th>
                                                                <th class="text-center">Descripción</th>
                                                                <th class="text-center">Stock</th>
                                                                <th class="text-center">Precio Compra</th>
                                                                <th class="text-center">Precio Venta</th>
                                                                <th class="text-center">Email Usuario</th>
                                                                <th class="text-center">Fecha Compra</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $contados = 0;
                                                            foreach ($productos_datos as $productos_dato) {
                                                                $id_producto = $productos_dato['id_producto'];
                                                                ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo ++$contados; ?></td>
                                                                    <td>
                                                                        <button class="btn btn-info" id="btn_selecionar<?php echo $id_producto;?>">
                                                                            Seleccionar
                                                                        </button>
                                                                        <script>
                                                                            $(document).ready(function() {
                                                                                $('#btn_selecionar<?php echo $id_producto; ?>').click(function() {

                                                                                    var id_producto = "<?php echo$id_producto;?>";
                                                                                    $('#id_producto').val(id_producto);

                                                                                    var producto = "<?php echo $productos_dato['nombre'];?>";
                                                                                    $('#producto').val(producto);

                                                                                    var detalle = "<?php echo $productos_dato['descripcion'];?>";
                                                                                    $('#detalle').val(detalle);


                                                                                    var precio_unitario = "<?php echo $productos_dato['precio_venta'];?>";
                                                                                    $('#precio_unitario').val(precio_unitario);

                                                                                    $('#cantidad').focus();


                                                                                    //$('#modal-buscar_producto').modal('toggle');
                                                                                });
                                                                            });
                                                                        </script>
                                                                    </td>
                                                                    <td class="text-center"><?php echo $productos_dato['codigo']; ?></td>
                                                                    <td class="text-center"><?php echo $productos_dato['nombre_categoria']; ?></td>
                                                                    <td class="text-center"><?php echo $productos_dato['nombre']; ?></td>
                                                                    <td class="text-center">
                                                                        <img src="<?php echo $URL . "/almacen/img-productos/" . $productos_dato['imagen']; ?>" width="50px" alt="Imagen producto">
                                                                    </td>
                                                                    <td class="text-center"><?php echo $productos_dato['descripcion']; ?></td>
                                                                    <td class="text-center"><?php echo $productos_dato['stock']; ?></td>
                                                                    <td class="text-center"><?php echo $productos_dato['precio_compra']; ?></td>
                                                                    <td class="text-center"><?php echo $productos_dato['precio_venta']; ?></td>
                                                                    <td class="text-center"><?php echo $productos_dato['email']; ?></td>
                                                                    <td class="text-center"><?php echo $productos_dato['fecha_ingreso']; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                                      <div class="row">
                                                          <div class="col-md-3">
                                                              <div class="form-group">
                                                                  <input type="text" id="id_producto" hidden>
                                                                  <label for="">Producto</label>
                                                                  <input type="text" id="producto" class="form-control" disabled>
                                                              </div>
                                                          </div>
                                                          <div class="col-md-3">
                                                              <div class="form-group">
                                                                  <label for="">Detalle</label>
                                                                  <input type="text" id="detalle" class="form-control" disabled>
                                                              </div>
                                                          </div>
                                                          <div class="col-md-3">
                                                              <div class="form-group">
                                                                  <label for="">Cantidad</label>
                                                                  <input type="text" id="cantidad" class="form-control">
                                                              </div>
                                                          </div>
                                                          <div class="col-md-3">
                                                              <div class="form-group">
                                                                  <label for="">Precio Unitario</label>
                                                                  <input type="text" id="precio_unitario" class="form-control" disabled>
                                                              </div>
                                                          </div>
                                                      </div>
                                                        <button class="btm btn-primary" id="btn_registrar_carrito" style="float: right">Registrar</button>
                                                        <div id="respuesta_carrito"></div>
                                                        <script>
                                                            $('#btn_registrar_carrito').click(function (){
                                                                var nro_venta = '<?php echo $contador_de_ventas + 1;?>';
                                                                var id_producto = $('#id_producto').val();
                                                                var cantidad = $('#cantidad').val();

                                                                if (id_producto === ""){
                                                                    alert("Debe seleccionar un producto");
                                                                } else if (cantidad === ""){
                                                                    alert("Debe agregar una cantidad del producto");
                                                                } else {
                                                                    var url = "../app/controllers/ventas/registrar_carrito.php";
                                                                    $.post(url, {
                                                                        nro_venta: nro_venta,
                                                                        id_producto: id_producto,
                                                                        cantidad: cantidad
                                                                    }, function (datos) {
                                                                        $('#respuesta_carrito').html(datos);
                                                                    });
                                                                }
                                                            });
                                                        </script>
                                                        <br><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <br><br>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th style="background-color: #e7e7e7;text-align: center">Nro</th>
                                            <th style="background-color: #e7e7e7;text-align: center">Producto</th>
                                            <th style="background-color: #e7e7e7;text-align: center">Detalle</th>
                                            <th style="background-color: #e7e7e7;text-align: center">Cantidad</th>
                                            <th style="background-color: #e7e7e7;text-align: center">Precio Unitario</th>
                                            <th style="background-color: #e7e7e7;text-align: center">Precio Subtotal</th>
                                            <th style="background-color: #e7e7e7;text-align: center">Accion</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $contador_de_carrito = 0;
                                        $cantidad_total = 0;
                                        $precio_unitario_total = 0;
                                        $precio_subtotal_total = 0;
                                        $nro_venta = $contador_de_ventas + 1;
                                        $sql_carrito = "SELECT *, pro.nombre as nombre_producto, pro.descripcion as descripcion_producto, pro.precio_venta as precio_producto FROM tb_carrito AS carr INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto WHERE nro_venta = '$nro_venta' ORDER BY id_carrito DESC";
                                        $query_carrito = $pdo->prepare($sql_carrito);
                                        $query_carrito->execute();
                                        $carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($carrito_datos as $carrito_dato){
                                            $id_carrito = $carrito_dato['id_carrito'];
                                            $contador_de_carrito = $contador_de_carrito + 1;
                                            $cantidad_total = $cantidad_total + $carrito_dato['cantidad'];
                                            $precio_unitario_total = $precio_unitario_total + floatval($carrito_dato['precio_producto']);
                                            ?>
                                            <tr>
                                                <td><center><?php echo $contador_de_carrito; ?></center> </td>
                                                <td><center><?php echo $carrito_dato['nombre_producto']; ?></center></td>
                                                <td><center><?php echo $carrito_dato['descripcion_producto']; ?></center></td>
                                                <td><center><?php echo $carrito_dato['cantidad']; ?></center></td>
                                                <td><center><?php echo $carrito_dato['precio_producto']; ?></center></td>
                                                <td>
                                                    <center>
                                                        <?php
                                                        $cantidad = floatval($carrito_dato['cantidad']);
                                                        $precio_venta = floatval($carrito_dato['precio_producto']);
                                                        echo $subtotal = $cantidad * $precio_venta;
                                                        $precio_subtotal_total = $precio_subtotal_total + $subtotal;
                                                        ?>
                                                    </center>
                                                </td>
                                                <td>
                                                    <center>
                                                        <form action="../app/controllers/ventas/delete.php" method="post">
                                                            <input type="text" name="id_carrito" value="<?php echo $id_carrito;?>" hidden>
                                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i>Eliminar del carrito</button>
                                                        </form>
                                                    </center>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <th colspan="3" style="background-color: #e7e7e7;text-align: right">Total</th>
                                        <th>
                                            <center>
                                                <?php
                                                echo $cantidad_total;
                                                ?>
                                            </center>
                                        </th>
                                        <th>
                                            <center>
                                                <?php
                                                echo $precio_unitario_total;
                                                ?>
                                            </center>
                                        </th>
                                        <th style="background-color: #FFF700">
                                            <center>
                                                <?php
                                                echo $precio_subtotal_total;
                                                ?>
                                            </center>
                                        </th>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.modal -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-user-check"></i> datos del cliente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>

                            </div>

                            <div class="card-body">
                                <b>Cliente</b>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-buscar_cliente">
                                    <i class="fa fa-search"></i>
                                    Buscar cliente
                                </button>
                                <!-- modal para visualizar datos de los clientes -->
                                <div class="modal fade" id="modal-buscar_cliente">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content modal-lg">
                                            <div class="modal-header" style="background-color: #0742d6;color: white">
                                                <h4 class="modal-title">Busqueda del cliente </h4>
                                                <div style="; width: 10px"></div>
                                                <button type="button" class="btn btn-info" style="font-weight: bold; color: #0a0e14; background-color: #e4d20b;" data-toggle="modal"
                                                        data-target="#modal-agregar_cliente">
                                                    <i class="fa fa-users" style="color: #0a0e14"></i>
                                                    Agregar cliente
                                                </button>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table id="example2" class="table table-bordered table-striped table-sm">
                                                            <thead>
                                                            <tr>
                                                                <th class="text-center">Nro</th>
                                                                <th class="text-center">Seleccionar</th>
                                                                <th class="text-center">nombre_cliente</th>
                                                                <th class="text-center">nit_ci_cliente</th>
                                                                <th class="text-center">celular_cliente</th>
                                                                <th class="text-center">email_cliente</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $contador_de_clientes = 0;
                                                            foreach ($clientes_datos as $clientes_dato) {
                                                                $id_cliente = $clientes_dato['id_cliente'];
                                                                $contador_de_clientes = $contador_de_clientes + 1;
                                                                ?>
                                                                <tr>
                                                                    <td class="text-center"><?php echo $contador_de_clientes; ?></td>
                                                                    <td>
                                                                        <button class="btn btn-info" id="btn_pasar_cliente<?php echo $id_cliente;?>">
                                                                            Seleccionar
                                                                        </button>
                                                                        <script>
                                                                            $(document).ready(function() {
                                                                                $('#btn_pasar_cliente<?php echo $id_cliente; ?>').click(function() {

                                                                                    var id_cliente = "<?php echo$id_cliente;?>";
                                                                                    $('#id_cliente').val(id_cliente);

                                                                                    var Nombre_Cliente = "<?php echo $clientes_dato['nombre_cliente'];?>";
                                                                                    $('#nombre_cliente').val(Nombre_Cliente);

                                                                                    var nit_ci_cliente = "<?php echo $clientes_dato['nit_ci_cliente'];?>";
                                                                                    $('#nit_ci_cliente').val(nit_ci_cliente);


                                                                                    var celular_cliente = "<?php echo $clientes_dato['celular_cliente'];?>";
                                                                                    $('#celular_cliente').val(celular_cliente);

                                                                                    var email_cliente = "<?php echo $clientes_dato['email_cliente'];?>";
                                                                                    $('#email_cliente').val(email_cliente);

                                                                                    $('#modal-buscar_cliente').modal('toggle');
                                                                                });
                                                                            });
                                                                        </script>
                                                                    </td>
                                                                    <td class="text-center"><?php echo $clientes_dato['nombre_cliente']; ?></td>
                                                                    <td class="text-center"><?php echo $clientes_dato['nit_ci_cliente']; ?></td>
                                                                    <td class="text-center"><?php echo $clientes_dato['celular_cliente']; ?></td>
                                                                    <td class="text-center"><?php echo $clientes_dato['email_cliente']; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                                        <br><br>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" id="id_cliente" hidden>
                                            <label for="">Nombre Cliente</label>
                                            <input type="text" class="form-control" id="nombre_cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Nit/Ci Cliente</label>
                                            <input type="text" class="form-control" id="nit_ci_cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Celular Cliente</label>
                                            <input type="text" class="form-control" id="celular_cliente">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="text" class="form-control" id="email_cliente">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-shopping-basket"></i> Registrar Venta</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Monto A Cancelar</label>
                                    <input style="background-color: #FFF700; font-weight: bold;" type="text" id="total_a_cancelar" class="form-control" value="<?php echo $precio_subtotal_total?>" disabled>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Total Pagado</label>
                                        <input type="text" id="total_pagado" class="form-control">
                                        <script>
                                            $(document).ready(function() {
                                                $('#total_pagado').keyup(function() {
                                                    var total_pagado = $('#total_pagado').val();

                                                    if (total_pagado === '') {
                                                        $('#cambio').val('');
                                                        return;
                                                    }

                                                    var total_a_cancelar = parseFloat($('#total_a_cancelar').val()) || 0;
                                                    total_pagado = parseFloat(total_pagado) || 0;

                                                    var cambio = total_pagado - total_a_cancelar;
                                                    $('#cambio').val(cambio.toFixed(2));
                                                });
                                            });
                                        </script>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Cambio</label>
                                        <input type="text" id="cambio" class="form-control" disabled>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <button id="btn_guardar_venta" class="btn btn-primary btn-block">Guardar Venta</button>
                                    <div id="respuesta_registro_de_ventas"></div>
                                    <script>
                                        $('#btn_guardar_venta').click(function (){

                                            var nro_venta = "<?php echo $contador_de_ventas + 1;?>";
                                            var id_cliente = $('#id_cliente').val();
                                            var total_a_cancelar = $('#total_a_cancelar').val();

                                            if (id_cliente == ""){
                                                alert("Debe seleccionar un cliente")
                                            }
                                            else {
                                               guardar_venta();
                                            }

                                            function actualizar_stock(){

                                            }

                                            function guardar_venta(){
                                                var url = "../app/controllers/ventas/registro_de_ventas.php";
                                                $.post(url, {
                                                    nro_venta: nro_venta,
                                                    id_cliente: id_cliente,
                                                    total_a_cancelar: total_a_cancelar
                                                }, function (datos) {
                                                    $('#respuesta_registro_de_ventas').html(datos);
                                                });
                                            }
                                        })
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->



        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">

        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2024 <a href="https://adminlte.io"></a>.</strong> Reservados todos los derechos.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap 4 -->
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo $URL?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<?php
if (isset($_SESSION['mensaje'])){
    $respuesta = $_SESSION['mensaje'];
    unset($_SESSION['mensaje']); // Eliminar el mensaje después de mostrarlo
    ?>
    <script>
        Swal.fire({
            icon: "error",
            title: "<?php echo $respuesta; ?>",
            text: "¡Algo salió mal!",
        })
    </script>
    <?php
}
?>

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $(function () {
        $("#example2").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Clientes",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,

        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

</script>



<!-- modal para agregar datos de los clientes -->
<div class="modal fade" id="modal-agregar_cliente">
    <center>
        <div class="modal-dialog modal-lg">
            <div class="modal-content modal-sm">
                <div class="modal-header" style="background-color: #cfa407;color: white">
                    <h4 class="modal-title" style="font-weight: bold; color: #0a0e14;">Nuevo cliente </h4>
                    <div style="; width: 10px"></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="../app/controllers/clientes/guardar_clientes.php" method="post">
                            <div class="form-group">
                                <label for="">Nombre del cliente</label>
                                <input type="text" name="nombre_cliente" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nit/Ci del cliente</label>
                                <input type="text" name="nit_ci_cliente" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Celular del cliente</label>
                                <input type="text" name="celular_cliente" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email del cliente</label>
                                <input type="email" name="email_cliente" class="form-control">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-warning btn-block" type="submit" style="font-weight: bold; color: #0a0e14; background-color: #e4d20b;">Guardar Cliente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </center>



    <?php
    if (isset($_SESSION['mensaje'])){
        $respuesta = $_SESSION['mensaje'];
        unset($_SESSION['mensaje']); // Eliminar el mensaje después de mostrarlo
        ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "<?php echo $respuesta; ?>",
                text: "¡Algo salió mal!",
            })
        </script>
        <?php
    }
    ?>
</body>
</html>