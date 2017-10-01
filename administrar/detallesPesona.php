<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['usuario'])) {
    echo 'Acceso denegado';
    exit();
}
if ($_GET) {
    require_once __DIR__ . '/../main/Fachada.php';
    $persona = Fachada::buscarPersona($_GET["nit"], $_GET["razon"]);
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary content">
            <div class="box-header with-border">
                <h3 class="box-title">Detalles </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="frmRegistrar" role="form" action="#">
                <div class="box-body">
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nitContratista">Nit Contratista</label>
                                <input name="nit" value="<?php echo $persona["nit"]; ?>"
                                       type="text"
                                       class="form-control" id="nitContratista" placeholder="Ingrese el nit">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="razonSocialContratista">Razon Social</label>
                                <input name="razon"
                                       value="<?php echo $persona["razon"]; ?>" type="text"
                                       class="form-control" id="razonSocialContratista"
                                       placeholder="Ingrese la razon">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label id="lbVinculo" for="cbVinculo">Tipo de documento</label>
                                <select name="vinculo" class="form-control" id="cbVinculo" required>
                                    <option value="EXTERNO">EXTERNO</option>
                                    <option value="INTERNO">INTERNO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label id="lbPersona" for="cbPersona">Tipo de documento</label>
                                <select name="tipo" class="form-control" id="cbPersona" required>
                                    <option value="NATURAL">Natural</option>
                                    <option value="JURIDICA">Juridica</option>
                                    <option value="NATURAL O JURIDICA">NATURAL O JURIDICA</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <a href="javascript:void(0)" type="submit" class="btn btn-default" id="btnRegresar">
                        <span class="glyphicon glyphicon-chevron-left"></span>Regresar</a>
                    <a href="javascript:void(0)" class="btn btn-default" id="btnRegistrar">
                        <span class="glyphicon glyphicon-ok"></span>
                        Registrar</a>


                </div>
            </form>
        </div>
    </div>
    <script>
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
        function enviar(data) {
            var solicitud = $.ajax({
                url: "<?php echo (isset($_GET["nit"]) and isset($_GET["razon"])) ? "../controlador/actualizarPersona.php" : "../controlador/registrarPersona.php"?>",
                data: $("#frmRegistrar").serialize(),
                method: "POST",
                dataType: "json"
            });
            return solicitud;
        }

        <?php
        if (isset($_GET["nit"]) and isset($_GET["razon"])) {
            $vinculo =strtoupper($persona["vinculo"]);
            $tipo =strtoupper($persona["tipopersona"]);
            echo "$('#cbVinculo').val('$vinculo').change();\n";
            echo "$('#cbPersona').val('$tipo').change();";
        }
        ?>
        $("#btnRegistrar").on("click",function () {
           var solicitud =enviar();
            solicitud.done(function (data) {
                //remover tr
                if (data.estado) {
                    mostrarMensaje("Sistema", data.mensaje, "alert alert-success", "#contenedor");
                } else {
                    mostrarMensaje("Sistema", data.mensaje, "alert alert-warning", "#contenedor");
                }

            });
            solicitud.fail(function (jqXHR, textStatus) {
                mostrarMensaje("Sistema", "Error " + textStatus, "alert alert-danger", "#contenedor");
            });
        });
    </script>
</div>