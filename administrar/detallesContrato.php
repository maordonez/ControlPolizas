<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    header('Location:../login.php');
    exit();
}
require_once __DIR__ . '/../main/Fachada.php';
$numeroContrato = $_GET['contrato'];
//contrato
$respuesta = Fachada::consultarContrato($numeroContrato);
$contrato = $respuesta["contrato"];
$egresos = $respuesta["egresos"];
//anexo contrato
$anexos = Fachada::listarAnexos();
$tipoContrato = $anexos["tipoContrato"];
$modalidadContrato = $anexos["modalidadContrato"];
$planGobierno = $anexos["planGobierno"];

?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom" id="nav-tabs-polizas">
            <ul class="nav nav-tabs pull-right">
                <li><a href="#tab_egresos" data-toggle="tab">Egresos</a></li>
                <li><a href="#tab_empresa" data-toggle="tab">Empresa</a></li>
                <li class="active"><a href="#tab_contrato" data-toggle="tab">Contrato</a></li>

                <li class="pull-left header"><i id="btnRegresar"
                                                class="btn btn-default glyphicon glyphicon-chevron-left"> Regresar</i>
                    Contrato # <?php echo $contrato->idContrato; ?>
                </li>
            </ul>
            <form id="formActualizar" role="form">
                <div class="tab-content">

                    <div class="tab-pane container-fluid" id="tab_egresos">
                        <div class="row">
                            <div class="col-md-12" id="contenedorEgresos">
                                <div class="table-responsive no-padding">
                                    <table class="table table-hover">
                                        <thead>
                                        <th>Egreso</th>
                                        <th>Fecha Mov</th>
                                        <th>Valor Cf</th>
                                        <th><a href="javascript:void(0)" class="btn btn-default" id="btnAgregar">
                                                <span class="glyphicon glyphicon-plus"></span>
                                                Agregar</a></th>
                                        </thead>
                                        <tbody id="bodyEgresos">
                                        <?php
                                        foreach ($egresos as $e) {
                                            echo "<tr>" .
                                                "<td>$e->egreso</td>" .
                                                "<td>$e->fechaMov</td>" .
                                                "<td>$e->valorCf</td>" .
                                                '<td><button id="modificar_' . $e->egreso . '" type="button" class="btn btn-default btnEditarEgreso"><i class="glyphicon glyphicon-pencil"></i></button><button id="eliminar_' . $e->egreso . '" type="button" class="btn btn-default btnEliminarEgreso"><i class="glyphicon glyphicon-trash"></i></button></td>'
                                                . "</tr>";
                                        }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane container-fluid" id="tab_empresa">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nitContratista">Nit Contratista</label>
                                    <input name="nitContratista" value="<?php echo $contrato->nitContratista; ?>"
                                           type="text"
                                           class="form-control" id="nitContratista" placeholder="Ingrese el nit">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="razonSocialContratista">Razon S. Contratista</label>
                                    <input name="razonSocialContratista"
                                           value="<?php echo $contrato->razonContratista; ?>" type="text"
                                           class="form-control" id="razonSocialContratista"
                                           placeholder="Ingrese la razon">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nitSupervisor">Nit Supervisor</label>
                                    <input name="nitSupervisor" value="<?php echo $contrato->nitSupervisor; ?>" type="text"
                                           class="form-control" id="nitSupervisor" placeholder="Ingrese el nit">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="razonSocialSupervisor">Razon S. Supervisor</label>
                                    <input name="razonSocialSupervisor"
                                           value="<?php echo $contrato->razonSupervisor; ?>" type="text"
                                           class="form-control" id="razonSocialSupervisor"
                                           placeholder="Ingrese la razon">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane active container-fluid" id="tab_contrato">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="idContrato">Numero de Contrato</label>
                                    <input name="idContrato" value="<?php echo $contrato->idContrato; ?>" type="text"
                                           class="form-control" id="idContrato"
                                           placeholder="Ingrese el numero de contrato">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fechaSuscripcion">Fecha Suscripcion</label>

                                    <div class="input-group date">
                                        <div id="pruebaBtn" class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input data-date-format='yyyy-mm-dd' name="fechaSuscripcion" type="text" class="datepickerCustom form-control pull-right" id="fechaSuscripcion">
                                    </div>
                                    <!-- /.input group -->
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fechaInicio">Fecha Inicio</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input data-date-format='yyyy-mm-dd' name="fechaInicio" type="text"
                                               class="datepickerCustom form-control pull-right" id="fechaInicio">
                                    </div>
                                    <!-- /.input group -->
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fechaFin">Fecha Fin</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input data-date-format='yyyy-mm-dd' name="fechaFin" type="text"
                                               class="datepickerCustom form-control pull-right"
                                               id="fechaFin">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Tipo de Contrato</label>
                                    <select name="tipoContrato" id="tipoContrato" class="form-control">
                                        <?php foreach ($tipoContrato as $tipo) {
                                            echo "<option value=\"$tipo\">$tipo</option>";
                                        } ?>

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Plan de gobierno</label>
                                    <select name="planGobierno" id="planGobierno" class="form-control">
                                        <?php foreach ($planGobierno as $plan) {
                                            echo "<option value=\"$plan\">$plan</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Modalidad de contrato</label>
                                    <select name="modalidad" id="modalidad" class="form-control">
                                        <?php foreach ($modalidadContrato as $modalidad) {
                                            echo "<option value=\"$modalidad\">$modalidad</option>";
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>
                                        <input name="contituyoFiducia" id="fiducia" type="checkbox" class="flat-red">
                                        Constituyo fiducia
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Objeto del Contrato</label>
                                    <textarea name="objetoContrato" class="form-control" rows="5"
                                              placeholder="Enter ..."><?php echo $contrato->objetoContrato; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"
                                               checked="">
                                        Dias
                                    </label>
                                    <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"
                                               checked="">
                                        Meses
                                    </label>
                                    <input type="number" class="form-control" id="cantidad"
                                           placeholder="Dias o Meses">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="valorContrato">Valor Contrato</label>
                                    <input name="valorContrato" type="number" class="form-control"
                                           value="<?php echo $contrato->valor; ?>" id="valorContrato"
                                           placeholder="Ingrese el valor">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="valorAnticipo">Valor Anticipo Contrato</label>
                                <div class="input-group">

                                <span class="input-group-addon">

                                    <input name="pactoAnticipo" type="checkbox" class="flat-red" id="estadoAnticipo">

                                </span>
                                    <input type="number" name="valorAnticipo"
                                           value="<?php echo $contrato->valorAnticipo; ?>" class="form-control"
                                           id="valorAnticipo">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="valorContrato">Rubro</label>
                                    <input name="rubro" type="text" class="form-control"
                                           value="<?php echo $contrato->rubro; ?>" id="rubro"
                                           placeholder="Ingrese el valor">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="numeroCompromiso">Numero de compromiso</label>
                                    <input name="numeroCompromiso" type="text" class="form-control"
                                           value="<?php echo $contrato->numeroCdp; ?>"
                                           id="numeroCompromiso" placeholder="Ingrese el numero">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fechaCompromiso">Fecha compromiso</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input data-date-format='yyyy-mm-dd' name="fechaCompromiso" type="text"
                                               class="datepickerCustom form-control pull-right" id="fechaCompromiso">
                                    </div>
                                    <!-- /.input group -->
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="valorCompromiso">valor compromiso</label>
                                    <input name="valorCompromiso" type="number" class="form-control"
                                           value="<?php echo $contrato->valorCdp; ?>"
                                           id="valorCompromiso" placeholder="Ingrese el numero">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="numeroCompromiso2">Numero de compromiso 2</label>
                                    <input name="numeroCompromiso2" type="text" class="form-control"
                                           value="<?php echo $contrato->numeroCdp2; ?>"
                                           id="numeroCompromiso2" placeholder="Ingrese el numero">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fechaCompromiso2">Fecha compromiso 2</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input data-date-format='yyyy-mm-dd' name="fechaCompromiso2" type="text"
                                               class="datepickerCustom form-control pull-right" id="fechaCompromiso2">
                                    </div>
                                    <!-- /.input group -->
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="valorCompromiso2">valor compromiso 2</label>
                                    <input name="valorCompromiso2" type="number" class="form-control"
                                           value="<?php echo $contrato->valorCdp2; ?>"
                                           id="valorCompromiso2" placeholder="Ingrese el numero">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="departamento">Departamento</label>
                                    <input name="departamento" type="text" class="form-control"
                                           value="<?php echo $contrato->departamento; ?>"
                                           id="departamento" placeholder="Ingrese el departamento">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="departamento">Ciudad</label>
                                    <input name="ciudad" type="text" class="form-control"
                                           value="<?php echo $contrato->ciudad; ?>"
                                           id="ciudad" placeholder="Ingrese la ciudad">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        <a id="btnGuardar" href="javascript:void(0)" class="btn btn-default" id="btnAgregar">
            <span class="glyphicon glyphicon-ok"></span>
            Guardar</a>
    </div>
</div>
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Egreso</h3>
            </div>
            <div class="modal-body">

                <!-- content goes here -->
                <form id="formEgreso">
                    <div class="form-group">
                        <label for="codigoEgreso">Egreso</label>
                        <input name="egreso" type="text" class="form-control" id="codigoEgreso"
                               placeholder="ingrese egreso">
                    </div>
                    <div class="form-group">
                        <label for="fechaEgreso">Fecha Egreso</label>
                        <input data-date-format='yyyy-mm-dd' name="fecha" type="text" class="form-control datepickerCustom" id="fechaEgreso">
                    </div>
                    <div class="form-group">
                        <label for="valorEgreso">Valor Egreso</label>
                        <input name="valor" type="number" class="form-control" id="valorEgreso">
                    </div>


                </form>

            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                        <button type="button" id="btnCancelar" class="btn btn-default" data-dismiss="modal"
                                role="button">Cerrar
                        </button>
                    </div>

                    <div class="btn-group" role="group">
                        <button type="button" id="btnRegistrar" class="btn btn-default btn-hover-green"
                                data-action="save" role="button">Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {


        function validarFormEgreso(){
            if($("#codigoEgreso").val()=='' || $("#fechaEgreso").val()=='' || $("#mensaje-alerta").val()==''){
                mostrarMensaje("Sistema","Ingrese todos los datos","alert alert-warning","#formEgreso");
                return false;
            }
            return true
        }
        function mostrarMensaje(titulo, mensaje, clase, contenedor) {
            $("#mensaje-alerta").remove();
            var html = '<div id="mensaje-alerta" class="' + clase + ' alert-dismissable">' +
                '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' +
                '<strong>' + titulo + '!</strong> ' + mensaje + ' </div>';
            $(contenedor).prepend(html);
        }


        /**
         * Metodo enviar una peticion al servidor
         * @param url direccion de servidor
         * @param formulario datos de formulario
         */
        function enviar(url, formulario) {
            var solicitud = $.ajax({
                url: url,
                data: formulario,
                method: "POST",
                dataType: "json"
            });
            return solicitud;
        }

        $("#tipoContrato").val("<?php echo trim($contrato->TipoContrato); ?>").change();
        $("#modalidad").val("<?php echo trim($contrato->modalidad); ?>").change();
        $("#planGobierno").val("<?php echo trim($contrato->planGobierno); ?>").change();
        //Date picker
        $('.datepickerCustom').datepicker({
            autoclose: true,
        });

        function formatDate(str1) {
// str1 format should be yyyy/mm/dd. Separator can be anything e.g. / or -. It wont effect
            var yr1 = parseInt(str1.substring(0, 4));
            var mon1 = parseInt(str1.substring(5, 7));
            var dt1 = parseInt(str1.substring(8, 10));
            var date1 = new Date(yr1, mon1 - 1, dt1);
            return date1;
        }
        <?php
        if (!is_null($contrato->fechaSuscripcion) and $contrato->fechaSuscripcion != '0000-00-00') {

            echo "console.log('$contrato->fechaSuscripcion');\n$('#fechaSuscripcion').datepicker('setDate',  formatDate('$contrato->fechaSuscripcion'));\n";
        }
        if (!is_null($contrato->fechaInicio) and $contrato->fechaInicio != '0000-00-00') {
            echo "$('#fechaInicio').datepicker('setDate', formatDate('$contrato->fechaInicio'));\n";
        }
        if (!is_null($contrato->fechaFin) and $contrato->fechaFin != '0000-00-00') {
            echo "$('#fechaFin').datepicker('setDate',  formatDate('$contrato->fechaFin'));\n";
        }
        if (!is_null($contrato->fechaCdp) and $contrato->fechaCdp != '0000-00-00') {
            echo "$('#fechaCompromiso').datepicker('setDate',  formatDate('$contrato->fechaCdp'));\n";
        }
        if (!is_null($contrato->fechaCdp2) and $contrato->fechaCdp2 != '0000-00-00') {
            echo "$('#fechaCompromiso2').datepicker('setDate',  formatDate('$contrato->fechaCdp2'));\n";
        }
        if (!is_null($contrato->fiducia)) {
            $valor = ($contrato->fiducia == 1) ? "true" : "false";
            echo "$('#fiducia').prop('checked',$valor);";
        }
        if (!is_null($contrato->pagoAnticipo)) {
            $valor = ($contrato->pagoAnticipo == 1) ? "true" : "false";
            echo "$('#estadoAnticipo').prop('checked',$valor);";
        }
        ?>

        //iCheck for checkbox and radio inputs
        $('#estadoAnticipo').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });
        $('#fiducia').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });


        $("#btnAgregar").on("click", function () {
            $("#squarespaceModal").modal();
            //evento registrar Egreso

            $('#codigoEgreso').prop("readonly", false);
            var btnRegistrar = $("#btnRegistrar");
            $(btnRegistrar).unbind("click");
            $(btnRegistrar).on("click", function () {
                if(validarFormEgreso()){
                    //ajax
                    var data = $("#formEgreso").serialize() + "&idContrato=" + $("#idContrato").val();
                    var solicitud = enviar("../controlador/registrarEgreso.php", data);
                    //solicitud completada
                    solicitud.done(function (data) {
                        if (data.estado) {
                            mostrarMensaje("Sistema", data.mensaje, "alert alert-success", "#formEgreso");
                            var eg=$("#codigoEgreso").val();
                            $("#bodyEgresos").append("<tr>" +
                                "<td>"+eg+"</td>" +
                                "<td>" + formatoFecha($("#fechaEgreso").val()) + "</td>" +
                                "<td>" + $("#valorEgreso").val() + "</td>"+
                                '<td><button id="modificar_'+eg+'" ' +
                                'type="button" class="btn btn-default btnEditarEgreso">' +
                                '<i class="glyphicon glyphicon-pencil"></i></button><button ' +
                                'id="eliminar_'+eg+'" type="button" ' +
                                'class="btn btn-default btnEliminarEgreso">' +
                                '<i class="glyphicon glyphicon-trash"></i></button></td></tr>');

                            $("#eliminar_"+eg).on("click", function () {
                                var td = $(this).parent();
                                var tr = $(td).parent();
                                //ajax
                                var data = "egreso=" + $(tr).find('td:eq(0)').html();
                                var solicitud = enviar("../controlador/eliminarEgreso.php", data);

                                solicitud.done(function (data) {
                                    //remover tr
                                    if (data.estado) {
                                        mostrarMensaje("Sistema", data.mensaje, "alert alert-success", "#contenedorEgresos");
                                        $(tr).remove();
                                    } else {
                                        mostrarMensaje("Sistema", data.mensaje, "alert alert-warning", "#contenedorEgresos");
                                    }

                                });
                                solicitud.fail(function (jqXHR, textStatus) {
                                    mostrarMensaje("Sistema", "Error " + textStatus, "alert alert-danger", "#contenedorEgresos");
                                });

                            });

                            $("#modificar_"+eg).on("click", function () {
                                var tr = $(this).parent().parent();
                                $("#codigoEgreso").val($(tr).find('td:eq(0)').html());

                                var cadenaFecha = $(tr).find('td:eq(1)').html();
                                $("#fechaEgreso").datepicker('setDate', formatDate(cadenaFecha));
                                $("#valorEgreso").val($(tr).find('td:eq(2)').html());
                                $('#codigoEgreso').prop("readonly", true);
                                //evento actualizar egreso
                                var btnRegistrar = $("#btnRegistrar");
                                $(btnRegistrar).unbind("click");
                                $(btnRegistrar).on("click", function () {
                                    if(validarFormEgreso()){
                                        var data = $("#formEgreso").serialize() + "&idContrato=" + $("#idContrato").val();
                                        var solicitud = enviar("../controlador/actualizarEgreso.php", data);

                                        solicitud.done(function (data) {
                                            if (data.estado) {
                                                mostrarMensaje("Sistema", data.mensaje, "alert alert-success", "#formEgreso");
                                                $(tr).find('td:eq(1)').html(formatoFecha($("#fechaEgreso").val()));
                                                $(tr).find('td:eq(2)').html($("#valorEgreso").val());

                                            } else {
                                                mostrarMensaje("Sistema", data.mensaje, "alert alert-warning", "#formEgreso");
                                            }
                                        });
                                        solicitud.fail(function (jqXHR, textStatus) {
                                            mostrarMensaje("Sistema", "Error " + textStatus, "alert alert-danger", "#formEgreso");
                                        })
                                    }
                                });

                                $("#squarespaceModal").modal();

                            });

                        } else {
                            mostrarMensaje("Sistema", data.mensaje, "alert alert-warning", "#formEgreso");
                        }
                    });
                    solicitud.fail(function (jqXHR, textStatus) {
                        mostrarMensaje("Sistema", "Error " + textStatus, "alert alert-danger", "#formEgreso");
                    });
                }

            });
        });

        function formatoFecha(cadena) {
            var array = cadena.split("/");
            return array[2] + "-" + array[0] + "-" + array[1];
        }

        function limpiarDialog() {
            $("#codigoEgreso").val("");
            $("#fechaEgreso").val("");
            $("#valorEgreso").val("");
            $("#mensaje-alerta").remove();
        }


        $("#squarespaceModal").on('hidden.bs.modal', function () {
            limpiarDialog();
        });

        function eventosTabla() {

            $(".btnEditarEgreso").on("click", function () {
                var tr = $(this).parent().parent();
                $("#codigoEgreso").val($(tr).find('td:eq(0)').html());

                var cadenaFecha = $(tr).find('td:eq(1)').html();
                $("#fechaEgreso").datepicker('setDate', formatDate(cadenaFecha));
                $("#valorEgreso").val($(tr).find('td:eq(2)').html());
                $('#codigoEgreso').prop("readonly", true);
                //evento actualizar egreso
                var btnRegistrar = $("#btnRegistrar");
                $(btnRegistrar).unbind("click");
                $(btnRegistrar).on("click", function () {
                    if(validarFormEgreso()){
                        var data = $("#formEgreso").serialize() + "&idContrato=" + $("#idContrato").val();
                        var solicitud = enviar("../controlador/actualizarEgreso.php", data);

                        solicitud.done(function (data) {
                            if (data.estado) {
                                mostrarMensaje("Sistema", data.mensaje, "alert alert-success", "#formEgreso");
                                $(tr).find('td:eq(1)').html(formatoFecha($("#fechaEgreso").val()));
                                $(tr).find('td:eq(2)').html($("#valorEgreso").val());

                            } else {
                                mostrarMensaje("Sistema", data.mensaje, "alert alert-warning", "#formEgreso");
                            }
                        });
                        solicitud.fail(function (jqXHR, textStatus) {
                            mostrarMensaje("Sistema", "Error " + textStatus, "alert alert-danger", "#formEgreso");
                        })
                    }

                });

                $("#squarespaceModal").modal();

            });
            $(".btnEliminarEgreso").on("click", function () {
                var td = $(this).parent();
                var tr = $(td).parent();
                //ajax
                var data = "egreso=" + $(tr).find('td:eq(0)').html();
                var solicitud = enviar("../controlador/eliminarEgreso.php", data);

                solicitud.done(function (data) {
                    //remover tr
                    if (data.estado) {
                        mostrarMensaje("Sistema", data.mensaje, "alert alert-success", "#contenedorEgresos");
                        $(tr).remove();
                    } else {
                        mostrarMensaje("Sistema", data.mensaje, "alert alert-warning", "#contenedorEgresos");
                    }

                });
                solicitud.fail(function (jqXHR, textStatus) {
                    mostrarMensaje("Sistema", "Error " + textStatus, "alert alert-danger", "#contenedorEgresos");
                });

            });


        }

        eventosTabla();

        $("#btnGuardar").on("click", function () {
            var url = "../controlador/actualizarContrato.php";
            var formulario = $("#formActualizar").serialize();
            var solicitud = enviar(url, formulario);
            solicitud.done(function (data) {
                //remover tr
                if (data.estado) {
                    mostrarMensaje("Sistema", data.mensaje, "alert alert-success", "#bodyContent");
                } else {
                    mostrarMensaje("Sistema", data.mensaje, "alert alert-warning", "#bodyContent");
                }

            });
            solicitud.fail(function (jqXHR, textStatus) {
                mostrarMensaje("Sistema", "Error ", "alert alert-danger", ".box-body");
            });
        });
    });
    function sumarFecha(dias){
        var fechaInicio= $("#fechaInicio");
        var dateInicio;
        if($(fechaInicio).val!=''){
            dateInicio=moment($(fechaInicio).datepicker('getDate')).format("YYYY-MM-DD");
        }
        else {
            dateInicio=moment($("#fechaSuscripcion").datepicker('getDate')).format("YYYY-MM-DD");
        }
        console.log(dateInicio);
        dateInicio.setDate(dateInicio.getDate()+dias);

        $("#fechaFin").datepicker('setDate',dateInicio);

    }
    $("#cantidad").keypress(function(e){
        if(e.which == 13) {
            sumarFecha(e.target.value);
        }
    });

</script>
