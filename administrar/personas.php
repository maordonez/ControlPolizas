<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location:../login.php');
    exit();
}
require_once __DIR__ . '/../main/Fachada.php';
$personas = Fachada::listarPersonas();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SCP | notificaciones</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../recursos/plugins/bootstrap/css/bootstrap.min.css">
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
                <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active">Personas</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content" id="contenedor">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Personas</h3>

                            <div class="box-tools">
                                <a href="javascript:void(0)" type="submit" class="btn btn-default pull-right" id="btnNuevo">
                                    <span class="glyphicon glyphicon-plus">Agregar</span></a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>nit</th>
                                    <th>razon social</th>
                                    <th>tipo persona</th>
                                    <th>vinculo</th>
                                    <th></th>
                                </tr>
                                <?php foreach ($personas as $p) { ?>
                                    <tr>
                                        <td><?php echo $p["nit"]; ?></td>
                                        <td><?php echo $p["razon"]; ?></td>
                                        <td><?php echo $p["tipoPersona"]; ?></td>
                                        <td><?php echo $p["vinculo"]; ?></td>
                                        <td>
                                            <button id="btnBuscar_<?php echo $p["nit"] ?>" type="button"
                                                    class="btn btn-default btnBusqueda"><i
                                                        class="glyphicon glyphicon-search"></i></button>
                                            <input value="<?php echo $p["razon"] ?>" type="hidden"></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>

        </section>

    </div>


</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../recursos/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../recursos/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- Icheck -->
<script src="../recursos/plugins/iCheck/icheck.min.js"></script>
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


<!-- xlsx archivos read ---->

<!-- AdminLTE for demo purposes -->
<script src="../recursos/app/js/demo.js"></script>
<script>
    $(document).ready(function () {
        var html;

        function crearEventos() {
            $(".btnBusqueda").on("click", function () {
                html = $("#contenedor").html();
                var array = this.id.split("_");
                var input = $(this).parent().find('input[type="hidden"]');
                var url = "detallesPesona.php?nit=" + array[1] + "&razon=" + $(input).val();
                $("#contenedor").load(encodeURI(url), function () {
                    $("#btnRegresar").on("click", function () {
                        $("#contenedor").html(html);
                        crearEventos();
                    });
                });
            });
            $("#btnNuevo").on("click",function () {
                var url = "detallesPesona.php";
                html = $("#contenedor").html()
                $("#contenedor").load(url, function () {
                    $("#btnRegresar").on("click", function () {
                        $("#contenedor").html(html);
                        crearEventos();
                    });
                });
            });
            }

        crearEventos();
    });
</script>
</body>
</html>

