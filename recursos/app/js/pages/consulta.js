/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    var listaContratos = [];
    var filtros = [];
    var contador = 0;
    var pagina = null;




    function celdaBtn(value) {
        //console.log(value);
        return '<button type="button" class="btn btn-default"><i class="fa fa-align-right"></i></button>';
    }
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

//*************************************************EVENTOS*****************************************************

    function iniciarEventos() {
        $(".check-filtro").iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });
        //eventos Icheck
        $(".check-filtro").on('ifChecked', function () {
            cambiarEstado(this, true);

        });

        $(".check-filtro").on('ifUnchecked', function () {
            cambiarEstado(this, false);
        });
        $(".table-btn-actualizar").on("click",function () {
            actualizarFila(this);
        });
        $(".table-btn-eliminar").on("click",function () {
            eliminarFila(this);
        });


    }
    $("#restablecerBusqueda").on("click", function () {
        aplicarFiltos();
    });
    $('#agregarFila').on("click", function () {
        crearEditor(-1);
    });
    function registrarFiltro(e) {
        var tipo = document.getElementById('cbConsulta_-1');
        var td = document.getElementById('contenedorFormulario_-1');
        var inputs = td.getElementsByTagName('input');
        var valor;
        var texto = '';
        if (inputs.length > 1) {
            valor = [inputs[0].value, inputs[1].value];
            texto += inputs[0].value + ' To ' + inputs[1].value;
        } else {
            valor = inputs[0].value;
            texto += inputs[0].value;
        }
        $("#filtros").append('<tr>' +
                '<td class="col-md-1 col-x-1">' +
                '<label><input type="checkbox" id="check_' + contador + '" class="check-filtro flat-red" checked></label>' +
                '</td>' +
                '<td class="col-md-8 col-xs-4" id ="contenedorFormulario_' + contador + '">' +
                '<b>' + MaysPrimera(tipo.value.replace("_", " ")) + '</b> - ' + texto +
                '</td>' +
                '<td class="col-md-1 col-x-1" id="contenedorBotones_' + contador + '">' +
                '<button id="btnActualizar_' + contador + '" class="table-btn-actualizar btn-view-fund btn btn-default btn-xs" type="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>' +
                '<button id="btnEliminar_' + contador + '" class="table-btn-eliminar btn-view-fund btn btn-default btn-xs" type="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button> ' +
                '</td>' +
                '</tr>');
        $('#check_' + contador).iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });
        //eventos Icheck
        $('#check_' + contador).on('ifChecked', function () {
            cambiarEstado(this, true);

        });

        $('#check_' + contador).on('ifUnchecked', function () {
            cambiarEstado(this, false);
        });
        document.getElementById('btnActualizar_' + contador).addEventListener("click", function () {
            actualizarFila(this);
        });
        document.getElementById('btnEliminar_' + contador).addEventListener("click", function () {
            eliminarFila(this);
        });
        filtros.push({"id": contador, "estado": true, "campo": tipo.value, "valor": valor});
        contador++;
        cancelarEditor(e);
        aplicarFiltos();
    }
    function eliminarFila(e) {

        var index = buscarIndice(obtenerId(e));
        if (index > -1) {
            filtros.splice(index, 1);
            var tr = $(e).parent().parent();
            $(tr).remove();
        }
        aplicarFiltos();
    }

    function actualizarFila(e) {
        var value = obtenerId(e);
        var index = buscarIndice(value);
        if (index > -1) {
            crearEditor(value);
        }
    }

    function completarActualizacion(e) {
        var val = obtenerId(e);
        var indice = buscarIndice(val);
        if (indice > -1) {
            var obj = filtros[indice];
            obj.campo = document.getElementById('cbConsulta_' + val).value;
            var resultado = obtenerValorInputs(val);
            obj.valor = resultado;
            generarTexto(resultado);
            $('#contenedorFormulario_' + val).html('<b>' + MaysPrimera(obj.campo.replace("_", " ")) + '</b> - ' + generarTexto(obj));
            $('#contenedorBotones_' + val).html('<button id="btnActualizar_' + val + '" class="btn-view-fund btn btn-default btn-xs" type="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>' +
                    '<button id="btnEliminar_' + val + '" class="btn-view-fund btn btn-default btn-xs" type="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button> ');
            document.getElementById('btnActualizar_' + val).addEventListener("click", function () {
                actualizarFila(this);
            });
            document.getElementById('btnEliminar_' + val).addEventListener("click", function () {
                eliminarFila(this);
            });
        }
        aplicarFiltos();
    }
    function cancelarEditor(e) {
        var val = obtenerId(e);
        var index = buscarIndice(val);
        $("#cbConsulta_" + val).select2('destroy');
        if (index > -1) {
            var obj = filtros[index];
            $('#contenedorFormulario_' + val).html('<b>' + MaysPrimera(obj.campo.replace("_", " ")) + "</b> - " + generarTexto(obj));
            $('#contenedorBotones_' + val).html('<button id="btnActualizar_' + val + '" class="btn-view-fund btn btn-default btn-xs" type="button"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></button>' +
                    '<button id="btnEliminar_' + val + '" class="btn-view-fund btn btn-default btn-xs" type="button"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button> ');
            document.getElementById('btnActualizar_' + val).addEventListener("click", function () {
                actualizarFila(this);
            });
            document.getElementById('btnEliminar_' + val).addEventListener("click", function () {
                eliminarFila(this);
            });
        } else {
            $('#contenedorFormulario_' + val).html('Agregar Filtro');
            $('#contenedorBotones_' + val).html('');
        }


    }
    function cambiarEstado(e, estado) {
        var val = obtenerId(e);
        var indice = buscarIndice(val);
        if (indice > -1) {
            filtros[indice].estado = estado;
        }
        aplicarFiltos();
    }
    function eventoSelect2(e) {

        var cb = e.currentTarget;
        var val = obtenerId(cb);
        var selector = 'contenedorCb_' + val;
        $("#contenedorFormulario_" + val + " div").each(function (index)
        {
            if ($(this).find('input').length) {
                $(this).remove();
            }

        });
        generarFormulario(val, cb.value, {});
    }


//***************************************Metodos auxiliares************************************************+
    function crearEditor(index) {
        var table = '<div class="col-md-4"><select class="form-control" id="cbConsulta_' + index + '">' +
                '<option value="numero_contrato">Numero de contrato</option>' +
                '<option value="tipo_contrato">Tipo de contrato</option>' +
                '<option value="nit_contratista">Nit contratista</option>' +
                '<option value="razon_contratista">Nombre contratista</option>' +
                '<option value="tipo_contratista">Tipo contratista</option>' +
                '<option value="plan_gobierno">Plan de gobierno</option>' +
                '<option value="rubro">Rubro</option>' +
                '<option value="objeto_contrato">Objeto del contrato</option>' +
                '<option value="fecha_suscripcion">Fecha suscripcion</option>' +
                '<option value="valor_contrato">Valor contrato</option>' +
                '<option value="valor_anticipo">Valor anticipo</option>' +
                '<option value="nit_supevisor">Nit supervisor</option>' +
                '<option value="razon_supevisor">Razon supervisor</option>' +
                '<option value="numero_cdp">Numero de CDP</option></select></div>';
        $('#contenedorFormulario_' + index).html(table);
        $("#cbConsulta_"+index).prop("selectedIndex", -1);
        $('#contenedorBotones_' + index).html('<button id="registrarFiltro_' + index + '" class="btn-view-fund btn btn-default btn-xs  pull-left" type="button"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button> <button id="cancelarRegistroFiltro_' + index + '"  class="btn-view-fund btn btn-default btn-xs  pull-left" type="button"><span class="glyphicon glyphicon-remove green" aria-hidden="true"></span></button> ');
        if (index > -1) {
            var obj = filtros[index];
            var campos = generarFormulario(index, obj.campo, obj);
            $('#contenedorFormulario_' + index).append(obj);
            $('#cbConsulta_' + index + " option").each(function () {
                if ($(this).val() === obj.campo) {
                    $(this).attr("selected", "selected");
                    return;
                }
            });
        }
        $('#cbConsulta_' + index).select2({
            width: '100%'
        }).on("change", function (e) {
            eventoSelect2(e);
        });
        document.getElementById('registrarFiltro_' + index).addEventListener("click", function () {
            var index = obtenerId(this);
            if (index > -1) {
                completarActualizacion(this);
            } else {
                registrarFiltro(this);
            }

        });
        document.getElementById('cancelarRegistroFiltro_' + index).addEventListener("click", function () {
            cancelarEditor(this);
        });
    }
    function buscarIndice(busqueda) {
        var size = filtros.length;
        for (var i = 0; i < size; i++) {
            if (filtros[i].id == busqueda) {
                return i;
            }
        }
        return -1;
    }

    function obtenerId(e) {
        var elementoId = (e.id);
        var vector = elementoId.split("_");
        return vector[1];
    }

    function generarFormulario(index, campo, obj) {
        var valor1 = '';
        var valor2 = '';
        var selector = '#contenedorFormulario_' + index;
        if (obj.hasOwnProperty('valor')) {
            if (isArray(obj.valor)) {
                var array = obj.valor;
                valor1 = array[0];
                valor2 = array[1];
            } else {
                valor1 = obj.valor;
            }

        }
        var html = '';
        switch (campo) {
            case 'fecha_suscripcion':

                html = '<div class="col-md-6"> <div class="input-group input-daterange">' +
                        '<input type="text" class="form-control" value="' + valor1 + '">' +
                        '<div class="input-group-addon">to</div>' +
                        '<input type="text" class="form-control" value="' + valor2 + '">' +
                        '</div></div>';
                $(selector).append(html);
                $('.input-daterange input').each(function () {
                    $(this).datepicker('clearDates');
                });
                break;
            case 'valor_contrato':
                html = '<div class="col-md-6"><div class="input-group"><input type="number" class="form-control" value="' + valor1 + '"><div class="input-group-addon">to</div><input type="number" class="form-control" value="' + valor2 + '"></div></div>';
                $(selector).append(html);
                break;
            default:
                html = '<div class="col-md-4"><input type="text" value="' + valor1 + '" class="form-control" id="datoConsulta"></div>';
                $(selector).append(html);
        }

    }

    function generarTexto(obj) {
        var respuesta = "";
        if (obj.hasOwnProperty('valor')) {
            var value = obj.valor;
            if (isArray(value)) {
                respuesta = value[0] + " To " + value[1];
            } else {
                respuesta = value;
            }
        }
        return respuesta;
    }
    function isArray(value) {
        return Object.prototype.toString.call(value) === "[object Array]";
    }

    function MaysPrimera(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    function obtenerValorInputs(index) {
        var td = document.getElementById('contenedorFormulario_' + index);
        var inputs = td.getElementsByTagName('input');
        var resultado = "";
        if (inputs.length > 1) {
            resultado = [];
            resultado.push(inputs[0].value);
            resultado.push(inputs[1].value);
        } else {
            resultado = inputs[0].value;
        }
        return resultado;
    }
    function aplicarFiltos() {
        var url = '../controlador/consultarContratos.php';
        var json = 'filtros=' + JSON.stringify(filtros);
        var jqxhr = $.post(url, json, function () {
        }, "json")
                .done(function (data) {
                    construirTbody("bodyContratos", data);
                })
                .fail(function () {
                    console.log("error");
                })
                .always(function () {
                    $("#append-example").tablesorter();
                });
// Set another completion function for the request above
        jqxhr.always(function () {
            console.log("second finished");
        });
    }

    function construirTbody(selector, data) {
        var cantidad = data.length;
        var tbody = '';
        for (var fila = 0; fila < cantidad; fila++) {
            var o =data[fila];
            tbody += construirTr(o);
        }
        $('#' + selector).html(tbody);

        $('.btnContrato').on("click", function () {

            var atributoId = this.id;
            var numeroContrato = atributoId.split('_')[1];
            pagina = $("#bodyContent").html();
            eventoTabla(numeroContrato);
        });
    }

    function eventoTabla(numero) {
        $("#bodyContent").load("detallesContrato.php?contrato=" + numero + "", function () {
            $("#btnRegresar").on("click", function () {
                $("#bodyContent").html(pagina);
                //recuperar eventos

                $('.btnContrato').on("click", function () {

                    var atributoId = this.id;
                    var numeroContrato = atributoId.split('_')[1];
                    pagina = $("#bodyContent").html();
                    eventoTabla(numeroContrato);
                });

                $("#restablecerBusqueda").on("click", function () {
                    aplicarFiltos();
                });
                $('#agregarFila').on("click", function () {
                    crearEditor(-1);
                });
                iniciarEventos();
            });
        });
    }
    function construirTr(fila) {
        console.log(fila.objetoContrato);
        var tr = '<tr>';
        tr += '<td>' + fila.idContrato + '</td>';
        tr += '<td>' + fila.TipoContrato + '</td>';
        tr += '<td>' + fila.contratista + '</td>';
        tr += '<td>' + fila.objetoContrato; + '</td>';
        tr += '<td>' + fila.rubro + '</td>';
        tr += '<td>' + fila.fechaSuscripcion + '</td>';
        tr += '<td>' + fila.fechaInicio + '</td>';
        tr += '<td>' + fila.fechaFin + '</td>';
        tr += '<td>' + fila.valor + '</td>';
        tr += '<td>' + fila.valorAnticipo + '</td>';
        tr += '<td>' + fila.supervisor + '</td>';
        tr += '<td>' + fila.numeroCdp + '</td>';
        tr += '<td>' + fila.valorCdp + '</td>';
        tr += '<td>' + fila.fechaCdp + '</td>';
        tr += '<td><button id="evento_' + fila.idContrato + '" type="button" class="btn btn-default btnContrato"><i class="glyphicon glyphicon-pencil"></i></button></td>';
        tr += '</tr>';
        return tr;
    }
}
);


