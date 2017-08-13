$(document).ready(function () {
    //json importado de documento xml o xlsm
    var out = {};
    var X = XLSX;
    var cont = 0;
    var formData = [];
    var contTable=0;


    /********************************** EVENTOSS ******************************/
    document.getElementById("cbTipoDocumento").value = "";
    $("#cbTipoDocumento").on("change", function () {
        var file = document.getElementById("fileDocumentos");
        var cb = document.getElementById("cbTipoDocumento");
        var lbFile = document.getElementById("fileName");
        if (cb.value == "Informe de contraloria") {
            out = {};
            lbFile.value = "";
            file.removeAttribute("disabled");
            file.setAttribute("accept", ".xlsx");

        }
        else if (cb.value == "Orden de comprobante de pago") {
            out = {};
            lbFile.value = "";
            file.removeAttribute("disabled");
            file.setAttribute("accept", ".xml");
        }
        else {
            out = {};
            lbFile.value = "";
            file.removeAttribute("accept");
            file.setAttribute("disabled");
        }

    });

    $('#btnAgregar').on('click', function () {
        var name = document.getElementById("fileName").value;
        var documento = document.getElementById("cbTipoDocumento").value;
        if(name!="" && documento!=""){
            agregarBox(name, documento);
            formData.push({"id": cont, "tipo": documento, "data": out});
            cont++;
            limpiarFormulario();
        }
        else{
            mostrarAlerta("Sistema","Ingrese todos los datos del formulario"," alert-warning");
        }


    });

    $('#btnLimpiar').on('click', function () {
        //limpiarFormulario();
        notificar({"170001":{"contrato":"exi","egreso":{"056247":"exi"}},"170002":{"contrato":"exi","egreso":{"056232":"exi"}},"170003":{"contrato":"exi","egreso":{"056238":"exi"}},"170004":{"contrato":"exi","egreso":{"056227":"exi"}},"170005":{"contrato":"exi","egreso":{"056246":"exi"}},"170006":{"contrato":"exi","egreso":{"056226":"exi"}},"170007":{"contrato":"exi","egreso":{"056233":"exi"}},"170008":{"contrato":"exi","egreso":{"056585":"exi"}},"170009":{"contrato":"exi","egreso":{"056433":"exi"}},"170010":{"contrato":"exi","egreso":{"056228":"exi"}},"170011":{"contrato":"exi","egreso":{"056239":"exi"}},"170012":{"contrato":"exi","egreso":{"056231":"exi"}},"170013":{"contrato":"exi","egreso":{"056230":"exi"}},"170014":{"contrato":"exi","egreso":{"056225":"exi"}},"170015":{"contrato":"exi","egreso":{"056183":"exi","056302":"exi","056655":"exi"}},"170016":{"contrato":"exi","egreso":{"056224":"exi","056176":"exi"}},"170017":{"contrato":"exi","egreso":{"056516":"exi"}},"170018":{"contrato":"exi","egreso":{"056229":"exi"}},"170019":{"contrato":"exi","egreso":{"056364":"exi"}},"170024":{"contrato":"exi","egreso":{"056593":"exi"}},"170025":{"contrato":"exi","egreso":{"056417":"exi"}},"170026":{"contrato":"exi","egreso":{"056507":"exi"}},"170028":{"contrato":"exi","egreso":{"056427":"exi"}},"170029":{"contrato":"exi","egreso":{"056501":"exi"}},"170030":{"contrato":"exi","egreso":{"056517":"exi"}},"170031":{"contrato":"exi","egreso":{"056473":"exi"}},"170032":{"contrato":"exi","egreso":{"056509":"exi"}},"170033":{"contrato":"exi","egreso":{"056515":"exi"}},"170034":{"contrato":"exi","egreso":{"056513":"exi"}},"170035":{"contrato":"exi","egreso":{"056349":"exi"}},"170036":{"contrato":"exi","egreso":{"056497":"exi"}},"170037":{"contrato":"exi","egreso":{"056237":"exi"}},"170038":{"contrato":"exi","egreso":{"056496":"exi"}},"170039":{"contrato":"exi","egreso":{"056375":"exi"}},"170041":{"contrato":"exi","egreso":{"056415":"exi"}},"170042":{"contrato":"exi","egreso":{"056510":"exi"}},"170043":{"contrato":"exi","egreso":{"056498":"exi"}},"170046":{"contrato":"exi","egreso":{"056499":"exi"}},"170047":{"contrato":"exi","egreso":{"056416":"exi"}},"170048":{"contrato":"exi","egreso":{"056514":"exi"}},"170050":{"contrato":"exi","egreso":{"056500":"exi"}},"170055":{"contrato":"exi","egreso":{"056589":"exi"}},"170056":{"contrato":"exi","egreso":{"056512":"exi"}},"170059":{"contrato":"exi","egreso":{"056579":"exi"}}});
    });

    $('#btnRegistrar').on('click', function () {
        var url = '../controlador/registrarImporte.php';
        var json = 'data=' + JSON.stringify(formData);


        $.ajax({
            url: url,
            data: json,
            method: "POST",
            dataType: "json",
            beforeSend: function () {
                waitingDialog.show('Espere Por Favor', {dialogSize: 'sm', progressType: 'warning'});
            }
        }).done(function (data) {
            notificar(data);
        }).fail(function () {
            mostrarAlerta("Sistema","Error de conexion","alert-warning");
        }).always(function () {
            waitingDialog.hide();
        });
    });

    $(".box-tools pull-right").on("click", ".btn btn-box-tool", function () {
        console.log("click");
    });

    function notificar(objetoajax){
     notificarTablas("orden",objetoajax);
     notificarTablas("informe",objetoajax);
    }
    function notificarTablas(clase,objetoajax){
        var estado= clase=="orden";
        var tablas=document.getElementsByClassName(clase);
        // if(Array.isArray(listado)){
        var nTablas=tablas.length;
        //recorrer tablas
        for(var i=0;i<nTablas;i++){
            var tb= tablas[i];
            var nRow=tb.rows.length;
            //recorrer filas
            for(var c=1;c<nRow;c++){
                var id=tb.rows[c].cells[0].innerHTML;
                if(objetoajax.hasOwnProperty(id)){
                    var obj= objetoajax[id];
                    marcar(obj,tb.rows[c],estado);
                }

            }
        }
    }
    function marcar(objeto,tr,tipoT) {
        if(objeto.contrato=='exi'){
            tr.cells[0].style.backgroundColor="#fff8b7"
        }
        else if(objeto.contrato=='!reg'){
            tr.cells[0].style.backgroundColor="#ffd4ed";
        }
        else if(objeto.contrato=='reg'){
            tr.cells[0].style.backgroundColor="#94f0b2";

        }

        if(tipoT && objeto.egreso!=null){
            var obj=objeto.egreso;
            var tbEgresos=tr.getElementsByTagName("table")[0];
            var nTb = tbEgresos.rows.length;
            for(var c=0;c<nTb;c++){
                var id =tbEgresos.rows[c].cells[0].innerHTML;
                if(obj.hasOwnProperty(id)){
                    var estado =obj[id];
                    if(estado=='exi'){
                        tbEgresos.rows[c].cells[0].style.backgroundColor="#fff8b7";

                    }
                    else if(estado=='reg'){
                        tbEgresos.rows[c].cells[0].style.backgroundColor="#94f0b2";
                    }
                    else{
                        tbEgresos.rows[c].cells[0].style.backgroundColor="#ffd4ed";
                    }
                }
            }
        }
    }
    if(!Array.isArray) {
        Array.isArray = function (value) {
            return Object.prototype.toString.call(value) === "[object Array]";
        };
    }

    function eventoEliminar(e) {
        var cadena = e.id;
        var array = cadena.split("-");
        eliminarElemento(array[1]);
    }

    function alertaError(titulo, mensaje) {
        $("#bodyContent").prepend('<div class="alert alert-danger alert-dismissible">' +
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
            '<h4><i class="icon fa fa-ban"></i> ' + titulo + '</h4>' +
            mensaje +
            '</div>');
    }

    function alertaExito(titulo, mensaje) {
        $("#bodyContent").prepend('<div class="alert alert-success alert-dismissible">' +
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
            '<h4><i class="icon fa fa-check"></i> ' + titulo + '</h4>' +
            mensaje +
            '</div>');
    }

//************************************UTILIDADES FORMULARIO****************************************
    function limpiarFormulario() {
        out = {};
        $('#fileName').val("");
    }

    function eliminarElemento(id) {
        var index = -1;
        var size = formData.length;
        for (var i = 0; i < size; i++) {
            if (formData[i].id === id) {
                index = i;
                break;
            }
        }
        if (index > -1) {
            splice(index, 1);
        }
        console.log(formData);
    }

    function fileName() {
        var fileName = $('#fileDocumentos').val();
        var vector = fileName.split('\\');
        var num = vector.length - 1;
        fileName = vector[num];

        return fileName;
    }


    /**
     * genera un caja contenedora
     * @returns {undefined}
     */
    function agregarBox(titulo, documento) {
        var jsonHtmlTable = ConvertJsonToTable(out,null, (documento=='Informe de contraloria')?'informe':'orden'+' table table-bordered', 'Download');
        var html = '<div class="row"><div class="col-md-12"><div class="box"><div class="box-header with-border"><h3 class="box-title">' + titulo + '&nbsp&nbsp<span class="label label-primary">' + documento + '</span>  </h3><div ' +
            'class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button><button id="btnEliminar_' + cont + '" type="button" class="btn btn-box-tool" data-widget="remove">' +
            '<i class="fa fa-times"></i></button></div></div><div class="box-body table-responsive no-padding" id="boxImport' + cont + '">' +
            jsonHtmlTable + '</div><div class="box-footer"><div class="row"></div></div></div></div></div>';
        $('#bodyContent').append(html);
        var el = document.getElementById("btnEliminar_" + cont);
        el.addEventListener("click", function () {
            eventoEliminar(this);
        }, false);
        contTable++;
    }

    //***************************************EXCEL XLSX Y XML*************************************************

    function agruparHojasXlsx(objeto) {
        var array = [];
        for (var x in objeto) {
            Array.prototype.push.apply(array, objeto[x]);
        }
        return array;
    }

    function fixdata(data) {
        var o = "", l = 0, w = 10240;
        for (; l < data.byteLength / w; ++l)
            o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w, l * w + w)));
        o += String.fromCharCode.apply(null, new Uint8Array(data.slice(l * w)));
        return o;
    }

    function to_json(workbook) {
        var result = {};
        workbook.SheetNames.forEach(function (sheetName) {
            var roa = X.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
            if (roa.length > 0) {
                result[sheetName] = roa;
            }
        });
        return result;
    }

    function xml_to_json(xml) {
        var array = new Array();
        $(xml).find("G_FUENTE1").each(function () {
            var obj = {};
            obj.CONSECUTIVO = $(this).find('CONSECUTIVO').text();
            obj.FUENTE = $(this).find('FUENTE1').text();
            obj.NIT = $(this).find('NIT').text();
            obj.FECHAMOV = $(this).find('FECHAMOV').text();
            obj.PORCONCEPTO = $(this).find('PORCONCEPTO').text();
            var egresos = [];
            $(this).find("G_EGRESO").each(function () {
                var egreso = {};
                egreso.EGRESO = $(this).find('EGRESO').text();
                egreso.CF_VALOR = $(this).find('CF_VALOR').text();
                egreso.CF_FECHA = $(this).find('CF_FECHA').text();
                egresos.push(egreso);
            });
            obj.egresos = egresos;
            array.push(obj);
        });
        return array;
    }

    function process_wb(wb) {
        out = agruparHojasXlsx(to_json(wb));
    }

    var xlf = document.getElementById('fileDocumentos');

    function handleFile(e) {
        var files = e.target.files;
        var f = files[0];
        var name = f.name;
        $('#fileName').val(name);

        var tipo = document.getElementById('cbTipoDocumento').value;
        if (tipo === 'Orden de comprobante de pago') {
            var readerXml = new FileReader();
            readerXml.readAsText(f);
            readerXml.onloadend = function () {
                var xmlData = $(readerXml.result);
                out = xml_to_json(xmlData);


            };

        } else {

            {
                rABS = document.getElementsByName("userabs")[0];
                use_worker = document.getElementsByName("useworker")[0];
                var reader = new FileReader();
                reader.onload = function (e) {
                    if (typeof console !== 'undefined')
                        console.log("onload", new Date());
                    var data = e.target.result;
                    if (use_worker) {
                        xw(data, process_wb);
                    } else {
                        var wb;
                        if (rABS) {
                            wb = X.read(data, {type: 'binary'});
                        } else {
                            var arr = fixdata(data);
                            wb = X.read(btoa(arr), {type: 'base64'});
                        }

                        process_wb(wb);
                    }
                };
                if (rABS)
                    reader.readAsBinaryString(f);
                else
                    reader.readAsArrayBuffer(f);
            }
        }

    }

    if (xlf.addEventListener)
        xlf.addEventListener('change', handleFile, false);
    
    function mostrarAlerta(titulo,mensaje,clase) {
        $("#alerta-mensaje").remove();

        var alert='<div id="alerta-mensaje" div class="alert '+clase+' alert-dismissible">' +
            '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
            '<h4><i class="icon fa fa-ban"></i> ' + titulo + '</h4>' +
            mensaje + '</div>';

        $("#bodyContent").prepend(alert);
    }

});

