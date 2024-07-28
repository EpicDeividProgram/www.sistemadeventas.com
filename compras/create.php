<?php
include ('../app/config.php');
include ('../app/controllers/almacen/lista_de_productos.php');
include ('../app/controllers/proveedores/listado_de_proveedores.php');
include ('../app/controllers/compras/listado_de_compras.php');
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
                        <h1 class="m-0">Registro de una nueva compra</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>


        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Llene los datos con cuidado</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-body" style="display: block;">
                                        <div style="display: flex">
                                            <h5>Datos del producto</h5>
                                            <div style="width: 20px"></div>
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

                                                                                                var id_producto = "<?php echo $productos_dato['id_producto'];?>";
                                                                                                $('#id_producto').val(id_producto);

                                                                                                var codigo = "<?php echo $productos_dato['codigo'];?>";
                                                                                                $('#codigo').val(codigo);

                                                                                                var categoria = "<?php echo $productos_dato['nombre_categoria'];?>";
                                                                                                $('#categoria').val(categoria);

                                                                                                var nombre = "<?php echo $productos_dato['nombre'];?>";
                                                                                                $('#nombre_producto').val(nombre);

                                                                                                var email = "<?php echo $productos_dato['email'];?>";
                                                                                                $('#usuario_producto').val(email);

                                                                                                var descripcion = "<?php echo $productos_dato['descripcion'];?>";
                                                                                                $('#descripcio_producto').val(descripcion);

                                                                                                var stock = "<?php echo $productos_dato['stock'];?>";
                                                                                                $('#stock').val(stock);
                                                                                                $('#stock_actual').val(stock);

                                                                                                var stock_minimo = "<?php echo $productos_dato['stock_minimo'];?>";
                                                                                                $('#stock_minimo').val(stock_minimo);

                                                                                                var stock_maximo = "<?php echo $productos_dato['stock_maximo'];?>";
                                                                                                $('#stock_maximo').val(stock_maximo);

                                                                                                var precio_compra = "<?php echo $productos_dato['precio_compra'];?>";
                                                                                                $('#precio_compra').val(precio_compra);

                                                                                                var precio_venta = "<?php echo $productos_dato['precio_venta'];?>";
                                                                                                $('#precio_venta').val(precio_venta);

                                                                                                var fecha_ingreso = "<?php echo $productos_dato['fecha_ingreso'];?>";
                                                                                                $('#fecha_ingreso').val(fecha_ingreso);

                                                                                                var ruta_img = "<?php echo $URL.'/almacen/img-productos/'.$productos_dato['imagen'];?>";
                                                                                                $('#img_producto').attr({src: ruta_img });

                                                                                                $('#modal-buscar_producto').modal('toggle');
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
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row" style="font-size: 12px">
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="text" id="id_producto" hidden>
                                                                    <label for="">Código:</label>
                                                                    <input type="text" class="form-control" id="codigo" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">Categoría:</label>
                                                                    <div style="display: flex">
                                                                        <input type="text" class="form-control" id="categoria" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">Nombre del producto:</label>
                                                                    <input type="text" name="nombre" id="nombre_producto" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="">Usuario</label>
                                                                    <input type="text" class="form-control" id="usuario_producto" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label for="">Descripción del producto:</label>
                                                                    <textarea name="descripcion" id="descripcio_producto" cols="30" rows="2" class="form-control" disabled></textarea>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="">Stock:</label>
                                                                    <input type="number" name="stock" id="stock" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="">Stock mínimo:</label>
                                                                    <input type="number" name="stock_minimo" id="stock_minimo" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="">Stock máximo:</label>
                                                                    <input type="number" name="stock_maximo" id="stock_maximo" " class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="">Precio compra:</label>
                                                                    <input type="number" name="precio_compra" id="precio_compra" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="">Precio venta:</label>
                                                                    <input type="number" name="precio_venta" id="precio_venta" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="">Fecha de ingreso:</label>
                                                                    <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" disabled>
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Imagen del producto</label>
                                                            <center>
                                                                <img src="<?php echo $URL."/almacen/img_productos/".$imagen;?>" id="img_producto" width="100%" alt="">
                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div style="display: flex">
                                                    <h5>Datos del Proveedor</h5>
                                                    <div style="width: 20px"></div>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#modal-buscar_proveedor">
                                                        <i class="fa fa-search"></i>
                                                        Buscar Proveedor
                                                    </button>
                                                    <!-- modal para visualizar datos de los productos -->
                                                    <div class="modal fade" id="modal-buscar_proveedor">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content modal-lg">
                                                                <div class="modal-header" style="background-color: #07b0d6;color: white">
                                                                    <h4 class="modal-title">Busqueda del proveedor</h4>
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
                                                                                    <th><center>Nro</center></th>
                                                                                    <th><center>Selecionar</center></th>
                                                                                    <th><center>Nombre del proveedor</center></th>
                                                                                    <th><center>Celular</center></th>
                                                                                    <th><center>Teléfono</center></th>
                                                                                    <th><center>Empresa</center></th>
                                                                                    <th><center>Email</center></th>
                                                                                    <th><center>Dirección</center></th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php
                                                                                $contador = 0;
                                                                                foreach ($proveedores_datos as $proveedores_dato){
                                                                                    $id_proveedor = $proveedores_dato['id_proveedor'];
                                                                                    $nombre_proveedor = $proveedores_dato['nombre_proveedor']; ?>
                                                                                    <tr>
                                                                                        <td><center><?php echo $contador = $contador + 1;?></center></td>
                                                                                        <td>
                                                                                            <button class="btn btn-info" id="btn_selecionar_proveedor<?php echo $id_proveedor;?>">
                                                                                                Selecionar
                                                                                            </button>
                                                                                            <script>
                                                                                                $('#btn_selecionar_proveedor<?php echo $id_proveedor;?>').click(function () {

                                                                                                    var id_proveedor = '<?php echo $id_proveedor; ?>';
                                                                                                    $('#id_proveedor').val(id_proveedor);

                                                                                                    var nombre_proveedor = '<?php echo $nombre_proveedor; ?>';
                                                                                                    $('#nombre_proveedor').val(nombre_proveedor);

                                                                                                    var celular_proveedor = '<?php echo $proveedores_dato['celular']; ?>';
                                                                                                    $('#celular').val(celular_proveedor);

                                                                                                    var telefono_proveedor = '<?php echo $proveedores_dato['telefono']; ?>';
                                                                                                    $('#telefono').val(telefono_proveedor);

                                                                                                    var empresa_proveedor = '<?php echo $proveedores_dato['empresa']; ?>';
                                                                                                    $('#empresa').val(empresa_proveedor);

                                                                                                    var email_proveedor = '<?php echo $proveedores_dato['email']; ?>';
                                                                                                    $('#email').val(email_proveedor);

                                                                                                    var direccion_proveedor = '<?php echo $proveedores_dato['direccion']; ?>';
                                                                                                    $('#direccion').val(direccion_proveedor);

                                                                                                    $('#modal-buscar_proveedor').modal('toggle');

                                                                                                });
                                                                                            </script>
                                                                                        </td>
                                                                                        <td><?php echo $nombre_proveedor;?></td>
                                                                                        <td>
                                                                                            <a href="https://wa.me/591<?php echo $proveedores_dato['celular'];?>" target="_blank" class="btn btn-success">
                                                                                                <i class="fa fa-phone"></i>
                                                                                                <?php echo $proveedores_dato['celular'];?>
                                                                                            </a>
                                                                                        </td>
                                                                                        <td><?php echo $proveedores_dato['telefono'];?></td>
                                                                                        <td><?php echo $proveedores_dato['empresa'];?></td>
                                                                                        <td><?php echo $proveedores_dato['email'];?></td>
                                                                                        <td><?php echo $proveedores_dato['direccion'];?></td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->
                                                </div>
                                                <hr>
                                                <div class="container-fluid" style="font-size: 12px">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" id="id_proveedor" hidden>
                                                                <label for="">Nombre del proveedor </label>
                                                                <input type="text" id="nombre_proveedor" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Celular</label>
                                                                <input type="number" id="celular" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Teléfono</label>
                                                                <input type="number" id="telefono" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Empresa </label>
                                                                <input type="text" id="empresa" class="form-control" disabled>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Email</label>
                                                                <input type="email" id="email" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Dirección</label>
                                                                <textarea name="" id="direccion" cols="30" rows="3" class="form-control" disabled></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group">
                                                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-outline card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Detalle de la compra</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>

                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?php
                                                    $contador_de_compras = 1;
                                                    foreach ($compras_datos as $compras_dato) {
                                                        $contador_de_compras = $contador_de_compras + 1;
                                                    }
                                                    ?>
                                                    <label for="">Número de la compra</label>
                                                    <input type="text" value="<?php echo $contador_de_compras; ?>" style="text-align: center" class="form-control" disabled>
                                                    <input type="text" value="<?php echo $contador_de_compras; ?>" id="nro_compra" hidden>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Fecha de la compra</label>
                                                    <input type="date" class="form-control" id="fecha_compra">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Comprobante de la compra</label>
                                                    <input type="text" class="form-control" id="comprobante">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Precio de la compra</label>
                                                    <input type="text" class="form-control" id="precio_compra_controlador">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Stock actual</label>
                                                    <input type="text" style="background-color: #fff819;text-align: center" id="stock_actual" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Stock Total</label>
                                                    <input type="text" style="text-align: center" id="stock_total" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Cantidad de la compra</label>
                                                    <input type="number" id="cantidad_compra" style="text-align: center" class="form-control">
                                                </div>
                                                <script>
                                                    $('#cantidad_compra').keyup(function () {
                                                        var stock_actual = $('#stock_actual').val();
                                                        var stock_compra = $('#cantidad_compra').val();

                                                        var total = parseInt(stock_actual)+ parseInt(stock_compra);
                                                        $('#stock_total').val(total);

                                                    });
                                                </script>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Usuario</label>
                                                    <input type="text" class="form-control" value="<?php echo $email_sesion; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button class="btn btn-primary btn-block" id="btn_guardar_compra">
                                                    Guardar compra
                                                </button>
                                            </div>
                                        </div>
                                        <script>
                                            $('#btn_guardar_compra').click(function (){
                                                var id_producto = $('#id_producto').val();
                                                var nro_compra = $('#nro_compra').val();
                                                var fecha_compra = $('#fecha_compra').val();
                                                var id_proveedor = $('#id_proveedor').val();
                                                var comprobante = $('#comprobante').val();
                                                var id_usuario = '<?php echo $id_usuario_sesion;?>';
                                                var precio_compra = $('#precio_compra_controlador').val();
                                                var cantidad_compra = $('#cantidad_compra').val();
                                                var stock_total = $('#stock_total').val();

                                                if (id_producto == "" || fecha_compra == "" || comprobante == "" || precio_compra == "" || cantidad_compra == "") {
                                                    alert("Debe llenar todos los campos");
                                                    return;
                                                }

                                                var url = "../app/controllers/compras/create.php";
                                                $.post(url, {
                                                    id_producto: id_producto,
                                                    nro_compra: nro_compra,
                                                    fecha_compra: fecha_compra,
                                                    id_proveedor: id_proveedor,
                                                    comprobante: comprobante,
                                                    id_usuario: id_usuario,
                                                    precio_compra: precio_compra,
                                                    cantidad_compra: cantidad_compra,
                                                    stock_total: stock_total
                                                }, function (datos) {
                                                    $('#respuesta_create').html(datos);
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>

                            <div id="respuesta_create"></div>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Proveedores",
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
</body>
</html>