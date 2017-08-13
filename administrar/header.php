<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    echo 'Acceso denegado';
    exit();
}
$data=$_SESSION['usuario'];
$polizas =$_SESSION['notificacion'];
$cantidad= count($polizas);
//print_r($data);
$url = '/ControlPolizas';
?>
<header class="main-header">

    <!-- Logo -->
    <a href="<?php echo $url; ?>/index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>CP</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Control Polizas</b> SCP</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a id="opcionMenu" href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning"><?php echo $cantidad; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Usted tiene <?php echo $cantidad; ?> notificaciones</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <?php foreach ($polizas as $p){?>
                                <li>
                                    <a href="#">
                                        <i class="glyphicon glyphicon-list"></i><?php echo "$p[TipoContrato] - $p[idContrato] - $p[dias] dias restantes"; ?>
                                    </a>
                                </li>
                                <?php }?>
                            </ul>
                        </li>
                        <li class="footer"><a href="<?php echo "$url/administrar/notificaciones.php"; ?>">Ver todas</a></li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $url; ?>/recursos/app/img/avatar5.png" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $data['nombres']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo $url; ?>/recursos/app/img/avatar5.png" class="img-circle" alt="User Image">

                            <p>
                                <?php echo $data['nombres']; ?> - Usuario del sistema
                                <small>activo</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                       
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat">Cambiar Contraseña</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="<?php echo $url; ?>/controlador/cerrarSesion.php"><i class="fa fa-power-off"></i></a>
                </li>
            </ul>
        </div>

    </nav>
</header>