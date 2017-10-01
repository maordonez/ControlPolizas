<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location:../login.php');
    exit();
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>SCP | documentos</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="../recursos/plugins/bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

        <!-- Theme style -->
        <link rel="stylesheet" href="../recursos/app/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="../recursos/app/css/skins/_all-skins.min.css">
        <style type="text/css">
            .scroll-wrapper { height: 500px; overflow: auto; }
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-red-light sidebar-mini sidebar-collapse">
        <!--        <div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
                    <div class="modal-header">
                        <h1>Processing...</h1>
                    </div>
                    <div class="modal-body">
                        <div class="progress progress-striped active">
                            <div class="bar" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>-->
        <div class="wrapper">

            <?php include './header.php'; ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php include './menu.php'; ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Sistema para el Control de Polizas
                        <small>Version 1.0</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Importar</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content" id="bodyContent">
                    <div class="row">

                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary content">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Importar Documentos</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                <form id="frmAgregar" role="form" action="#">
                                    <div class="box-body">
                                        <br>
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="form-group">
                                                    <label id="lbTipoDocumento" for="cbTipoDocumento">Tipo de documento</label>
                                                    <select  class="form-control" id="cbTipoDocumento" required>
                                                        <option disabled selected value> -- Seleccione una opcion -- </option>
                                                        <option value="Orden de comprobante de pago">Orden de comprobante de pago</option>
                                                        <option value="Informe de contraloria">Informe de contraloria</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <input type="text" id="fileName" class="form-control" readonly required>
                                                    <label class="input-group-btn">
                                                        <span class="btn btn-primary">
                                                            <span class="glyphicon glyphicon-folder-open"></span><input type="file" id="fileDocumentos" style="display: none;" disabled required>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <a href="javascript:void(0)" type="submit" class="btn btn-primary" id="btnAgregar">
                                            <span class="glyphicon glyphicon-plus"></span>Agregar</a>
                                        <a href="javascript:void(0)" class="btn btn-danger" id="btnLimpiar">
                                            <span class="glyphicon glyphicon-trash"></span>
                                            Limpiar</a>
                                        <a href="javascript:void(0)" class="btn btn-primary pull-right" id="btnRegistrar">
                                            <span class="glyphicon glyphicon-ok"></span> Registrar</a>

                                    </div>
                                </form>
                            </div>
                            <!-- /.box -->
                        </div>
                    </div>


                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <?php require './footer.php'; ?>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Create the tabs -->
                <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                    <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                    <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Home tab content -->
                    <div class="tab-pane" id="control-sidebar-home-tab">
                        <h3 class="control-sidebar-heading">Recent Activity</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                        <p>Will be 23 on April 24th</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-user bg-yellow"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                                        <p>New phone +1(800)555-1234</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                                        <p>nora@example.com</p>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon fa fa-file-code-o bg-green"></i>

                                    <div class="menu-info">
                                        <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                                        <p>Execution time 5 seconds</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                        <h3 class="control-sidebar-heading">Tasks Progress</h3>
                        <ul class="control-sidebar-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Custom Template Design
                                        <span class="label label-danger pull-right">70%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Update Resume
                                        <span class="label label-success pull-right">95%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Laravel Integration
                                        <span class="label label-warning pull-right">50%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <h4 class="control-sidebar-subheading">
                                        Back End Framework
                                        <span class="label label-primary pull-right">68%</span>
                                    </h4>

                                    <div class="progress progress-xxs">
                                        <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <!-- /.control-sidebar-menu -->

                    </div>
                    <!-- /.tab-pane -->

                    <!-- Settings tab content -->
                    <div class="tab-pane" id="control-sidebar-settings-tab">
                        <form method="post">
                            <h3 class="control-sidebar-heading">General Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Report panel usage
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Some information about this general settings option
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Allow mail redirect
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Other sets of options are available
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Expose author name in posts
                                    <input type="checkbox" class="pull-right" checked>
                                </label>

                                <p>
                                    Allow the user to show his name in blog posts
                                </p>
                            </div>
                            <!-- /.form-group -->

                            <h3 class="control-sidebar-heading">Chat Settings</h3>

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Show me as online
                                    <input type="checkbox" class="pull-right" checked>
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Turn off notifications
                                    <input type="checkbox" class="pull-right">
                                </label>
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label class="control-sidebar-subheading">
                                    Delete chat history
                                    <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                                </label>
                            </div>
                            <!-- /.form-group -->
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </aside>
            <!-- /.control-sidebar -->
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.2.3 -->
        <script src="../recursos/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="../recursos/plugins/bootstrap/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../recursos/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../recursos/app/js/app.js"></script>
        <!-- Sparkline -->
        <script src="../recursos/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- xlsx archivos read ---->
        <script src="../recursos/plugins/xlsx/shim.js"></script>
        <script src="../recursos/plugins/xlsx/xlsx.full.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../recursos/plugins/table/json_to_html.js"></script>
        <script src="../recursos/app/js/demo.js"></script>
        <script src="../recursos/plugins/bootstrap-waitingfor/waitingfor.js"></script>
        <script type="text/javascript" src="../recursos/app/js/pages/importar.js"></script>
    </body>
</html>

