<?php
$id_venta_get = $_GET['id_venta'];
include ('../app/config.php');
include('../app/controllers/ventas/cargar_venta.php');
include('../app/controllers/clientes/cargar_cliente.php');
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
                        <h1 class="m-0">Detalle de la Venta Nro <?= $nro_venta; ?></h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm table-hover table-striped">
                                        <thead>
                                        <tr>
                                            <th style="background-color: #e7e7e7; text-align: center">Nro</th>
                                            <th style="background-color: #e7e7e7; text-align: center">Producto</th>
                                            <th style="background-color: #e7e7e7; text-align: center">Descripción</th>
                                            <th style="background-color: #e7e7e7; text-align: center">Cantidad</th>
                                            <th style="background-color: #e7e7e7; text-align: center">Precio Unitario</th>
                                            <th style="background-color: #e7e7e7; text-align: center">Precio Subtotal</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $contador_de_carrito = 0;
                                        $total = 0;

                                        $sql_carrito = "SELECT *, pro.nombre as nombre, pro.descripcion as descripcion, pro.precio_venta as precio, pro.stock as stock, pro.id_producto as id_producto FROM tb_carrito as carr 
                                                        INNER JOIN tb_almacen as pro on carr.id_producto = pro.id_producto WHERE nro_venta = '$nro_venta' ORDER BY id_carrito ASC";
                                        $query_carrito = $pdo->prepare($sql_carrito);
                                        $query_carrito->execute();
                                        $carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($carrito_datos as $carrito_dato) {
                                            $contador_de_carrito = $contador_de_carrito + 1;
                                            $id_carrito = $carrito_dato['id_carrito'];
                                            ?>
                                            <tr>
                                                <td>
                                                    <center><?php echo $contador_de_carrito; ?></center>
                                                    <input type="text" value="<?php echo $carrito_dato['id_producto']; ?>" id="id_producto<?php echo $contador_de_carrito; ?>" hidden>
                                                </td>
                                                <td><center><?php echo $carrito_dato['nombre']; ?></center></td>
                                                <td><center><?php echo $carrito_dato['descripcion']; ?></center></td>
                                                <td>
                                                    <center><span id="cantidad_carrito<?php echo $contador_de_carrito; ?>"><?php echo $carrito_dato['cantidad']; ?></span></center>
                                                    <input type="text" value="<?php echo $carrito_dato['stock'];?>" id="stock_de_inventario<?php echo $contador_de_carrito; ?>" hidden>
                                                </td>
                                                <td><center><?php echo $carrito_dato['precio']; ?></center></td>
                                                <td><center>
                                                        <?php
                                                        $cantidad = $carrito_dato['cantidad'];
                                                        $precio = $carrito_dato['precio'];
                                                        echo $subtotal = $cantidad * $precio;
                                                        $total = $total + $subtotal;
                                                        ?>
                                                    </center></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <th colspan="4"></th>
                                            <th style="background-color:#98FB98; text-align: right">TOTAL</th>
                                            <th style="background-color:#98FB98;">
                                                <center><?php echo $total; ?></center>
                                            </th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-user-check"></i> Datos del Cliente</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <?php
                            foreach ($clientes_datos as $clientes_dato)
                            {
                                $nombre_cliente = $clientes_dato['nombre_cliente'];
                                $dni_cliente = $clientes_dato['dni_cliente'];
                                $telefono_cliente = $clientes_dato['telefono_cliente'];
                                $mail_cliente = $clientes_dato['mail_cliente'];
                                $direccion_cliente = $clientes_dato['direccion_cliente'];
                            }
                            ?>

                            <div class="card-body">
                                <!-- Modal para ver datos de los cliente -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" id="id_cliente" hidden>
                                            <label for="">Nombre Cliente</label>
                                            <input type="text" value="<?php echo $nombre_cliente; ?>" class="form-control" id="nombre_cliente" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Dni</label>
                                            <input type="text" value="<?php echo $dni_cliente; ?>" class="form-control" id="dni_cliente" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Teléfono</label>
                                            <input type="text" value="<?php echo $telefono_cliente; ?>" class="form-control" id="telefono_cliente" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="">Mail</label>
                                            <input type="text" value="<?php echo $mail_cliente; ?>" class="form-control" id="mail_cliente" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Dirección</label>
                                            <input type="text" value="<?php echo $direccion_cliente; ?>" class="form-control" id="direccion_cliente" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
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
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

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

