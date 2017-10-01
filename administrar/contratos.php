<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SCP | contratos</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="../recursos/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../recursos/plugins/tablesorter/css/theme.bootstrap.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="../recursos/plugins/select2/select2.min.css">
        <!-- daterange picker -->
        <link rel="stylesheet" href="../recursos/plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="../recursos/plugins/datepicker/datepicker3.css">
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="../recursos/plugins/iCheck/all.css">

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
            .scroll-wrapper1 { height: 200px; overflow: auto; }
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-red-light sidebar-mini sidebar-collapse">
        <div class="wrapper">
            <?php include './header.php'; ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php include './menu.php'; ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        SCP
                        <small>Version 2.0</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Consultas</li>
                        <li class="active">Contratos</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content" id="bodyContent">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-info collapsed-box">
                                <div class="box-header">
                                    <i class="fa fa-search"></i>
                                    <h3 class="box-title">Filtros
                                        <small>busqueda avanzada</small>
                                    </h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                                            <i class="fa fa-plus"></i></button>
                                    </div>
                                    <!-- /. tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body pad" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-8">

                                            <div class="table-responsive scroll-wrapper1">
                                                <table class="table table-sm table-hover"> 
                                                    <tbody id="filtros">
                                                        <tr>
                                                            <td class="field-label col-md-1 col-xs-1">
                                                                <button id="agregarFila" class="btn-view-fund btn btn-default btn-xs  pull-left" type="button">
                                                                    <span class="glyphicon glyphicon-plus green" aria-hidden="true"></span>
                                                                </button> 
                                                            </td>
                                                            <td class="col-md-8 col-xs-4" id="contenedorFormulario_-1">
                                                                Agregar Filtro
                                                            </td>
                                                            <td id="contenedorBotones_-1" class="col-md-1 col-xs-1">
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <i class="fa fa-table"></i>

                                    <h3 class="box-title">Contratos</h3>

                                    <div class="col-md-2 pull-right">
                                        <button id="restablecerBusqueda" class="btn btn-default">Mostrar Todos</button>
                                    </div>
                                    <div class="col-md-1 pull-right">
                                        <a href="exportar.php" target="_blank" type="submit" class="btn btn-default" id="btnAgregar">
                                            <span class="glyphicon glyphicon-plus"></span>Exportar</a>

                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div id="listadoContratos" class="box-body">    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive no-padding scroll-wrapper">
                                                <table id="append-example" class="table table-hover">
                                                    <thead>
                                                    <th>#</th>
                                                    <th>tipo</th>
                                                    <th>contratista</th>
                                                    <th>objeto contrato</th>
                                                    <th>rubro</th>
                                                    <th>fechaS</th>
                                                    <th>fechaI</th>
                                                    <th>fechaF</th>
                                                    <th>valorC</th>
                                                    <th>valorA</th>
                                                    <th>supervisor</th>
                                                    <th>#Cdp</th>
                                                    <th>valorCdp</th>
                                                    <th>fechaCdp</th>
                                                    <th></th>
                                                    </thead>
                                                    <tbody id="bodyContratos">

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                                <!-- /.box -->
                            </div>
                        </div>
                </section>

            </div> 

            <?php require './footer.php'; ?>



        </div>
        <!-- ./wrapper -->

        <!-- jQuery 2.2.3 -->
        <script src="../recursos/plugins/jQuery/jquery-2.2.3.min.js"></script>

        <!-- Bootstrap 3.3.6 -->
        <script src="../recursos/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../recursos/plugins/tablesorter/js/jquery.tablesorter.min.js"></script>
        <script src="../recursos/plugins/tablesorter/js/jquery.tablesorter.widgets.min.js"></script>
        <!-- Select2 -->
        <script src="../recursos/plugins/select2/select2.full.min.js"></script>
        <!-- date-range-picker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="../recursos/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap datepicker -->
        <script src="../recursos/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- FastClick -->
        <script src="../recursos/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="../recursos/app/js/app.min.js"></script>
        <!-- Sparkline -->
        <script src="../recursos/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- Icheck -->
        <script src="../recursos/plugins/iCheck/icheck.min.js"></script>
        <!-- xlsx archivos read ---->

        <!-- AdminLTE for demo purposes -->
        <script src="../recursos/app/js/demo.js"></script>
        <script src="../recursos/app/js/pages/consulta.js"></script>
    </body>
</html>

