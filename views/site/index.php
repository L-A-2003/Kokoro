<?php


use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
?>

<style>
    table thead tr th {
        width: 25%;
    }
</style>

<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-8">

            <div class="row mt-3">
                <div class="col">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link accion active" href="#" id="Venta">Venta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link accion" href="#" id="Compra">Compra</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link accion" href="#" id="Encargue">Encargue</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <ul class="nav nav-tabs" id="tipoAccion">
                        <li class="nav-item">
                            <a class="nav-link tipoAccion active" href="#" id="Factura">Factura</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tipoAccion" href="#" id="NotaCredito">Nota de crédito</a>
                        </li>
                    </ul>
                </div>
            </div>

            <input type="hidden" id="tipoDocumento" value="VentaFactura" name="tipo"></input>

            <div id="filaProductos">
                <div class="row mt-3">
                    <div class="col-8">
                        <div class="row mt-3" id="filaProducto">
                            <div class="col-2 text-end">
                                <label>Producto:</label>
                            </div>
                            <div class="col">
                                <select class="js-example-placeholder-single js-states form-control" id="selectProducto" onchange="cargarTallesProducto(this.value)">
                                    <option value=""></option>
                                    <?php foreach ($productos as $producto) { ?>
                                        <option value="<?= $producto->id ?>_<?= $producto->prod_nombre ?>"><?= $producto->prod_nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-2 text-end">
                                <label>Talle:</label>
                            </div>
                            <div class="col">
                                <select class="js-example-placeholder-single js-states form-control" id="selectTallesProducto">
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-2 mt-3 text-start">
                        <button class="btn btn-primary h-100" onclick="agregarProductoCarrito()"><i class="fa-sharp fa-solid fa-cart-plus"></i></button>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <table id="tablaCarrito" class="row-border items table table-condensed hover nowrap">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Talle</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <table class="row-border items table table-condensed hover nowrap">
                            <thead>
                                <tr>
                                    <th>Total:</th>
                                    <th></th>
                                    <th id="totalPrecio">0</th>
                                    <th id="totalCantidad">0</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>

            <div class="row mt-3" id="filaVentaNotaCredito">
                <div class="col">
                    <table id="tablaVentaNotaCredito" class="row-border items table table-condensed hover nowrap">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="row mt-3" id="filaCompraNotaCredito">
                <div class="col">
                    <table id="tablaCompraNotaCredito" class="row-border items table table-condensed hover nowrap">
                        <thead>
                            <tr>
                                <th>Proveedor</th>
                                <th>Total</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-4">
            <div class="container-fluid">

                <div class="row mt-3 justify-content-center" id="filaCliente">
                    <div class="col-3 text-end">
                        <label>Cliente:<span class="text-danger" id="lblCliente">*<span></label>
                    </div>
                    <div class="col">
                        <select class="form-control" id="cliente">
                            <option value="">Seleccione una opción</option>
                            <?php foreach ($clientes as $cliente) { ?>
                                <option value="<?= $cliente->cliprov_documento ?>"><?= $cliente->cliprov_nombre . " " . $cliente->cliprov_apellido ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row mt-3 justify-content-center" id="filaProveedor">
                    <div class="col-3 text-end">
                        <label>Proveedor:<span class="text-danger">*<span></label>
                    </div>
                    <div class="col">
                        <select class="form-control" id="proveedor">
                            <option value="">Seleccione una opción</option>
                            <?php foreach ($proveedores as $proveedor) { ?>
                                <option value="<?= $proveedor->cliprov_documento ?>"><?= $proveedor->cliprov_nombre ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="row mt-3 justify-content-center" id="filaFormaPago">
                    <div class="col-3 text-end">
                        <label>Forma de pago:<span class="text-danger">*<span></label>
                    </div>
                    <div class="col">
                        <select class="form-control" id="formaPago">
                            <option value="">Seleccione una opción</option>
                            <option value="contado">Contado</option>
                            <option value="credito">Crédito</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-3 justify-content-center">
                    <div class="col-3 text-end">
                        <label>Adenda:</label>
                    </div>
                    <div class="col">
                        <textarea class="form-control" placeholder="Adenda" rows="7" id="adenda"></textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col text-end me-3 pe-2">
            <button class="btn btn-primary" onclick="finalizarAccion()">Finalizar</button>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $("#tablaCarrito").DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay informacion disponible",
                "info": "Mostrando _START_ de _END_ de un total de _TOTAL_",
                "infoEmpty": "Mostrando 0 de 0 de un total de 0",
                "infoFiltered": "(Filtrado de un total de _MAX_)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_",
                "loadingRecords": "Cargando...",
                "processing": "",
                "search": "Buscar:",
                "zeroRecords": "No hay informacion que conincida",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
            },
            scrollY: "100px",
            scrollCollapse: true,
            bFilter: false,
            bInfo: false,
            paging: false,
            ordering: false,
        });

        $("#tablaVentaNotaCredito").DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay informacion disponible",
                "info": "Mostrando _START_ de _END_ de un total de _TOTAL_",
                "infoEmpty": "Mostrando 0 de 0 de un total de 0",
                "infoFiltered": "(Filtrado de un total de _MAX_)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_",
                "loadingRecords": "Cargando...",
                "processing": "",
                "search": "Buscar:",
                "zeroRecords": "No hay informacion que conincida",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
            },
            bFilter: false,
            bInfo: false,
            ordering: false,
            dom: "rtip",
        });

        $("#tablaCompraNotaCredito").DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay informacion disponible",
                "info": "Mostrando _START_ de _END_ de un total de _TOTAL_",
                "infoEmpty": "Mostrando 0 de 0 de un total de 0",
                "infoFiltered": "(Filtrado de un total de _MAX_)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_",
                "loadingRecords": "Cargando...",
                "processing": "",
                "search": "Buscar:",
                "zeroRecords": "No hay informacion que conincida",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                },
            },
            bFilter: false,
            bInfo: false,
            ordering: false,
            dom: "rtip",
        });

        $(".dataTables_empty").remove();

        cambioDocumento();

        $(".nav-tabs .nav-item .nav-link.accion").on("click", function() {
            $(".nav-tabs .nav-item .nav-link.accion").removeClass("active");
            $(this).addClass("active");

            accion = $(this).attr("id");

            if (accion != "Encargue") {

                tipoAccion = $(".nav-tabs .nav-item .nav-link.tipoAccion.active").attr("id");
                $("#tipoAccion").show();
                $("#tipoDocumento").val(accion + tipoAccion);
            } else {
                $("#tipoAccion").hide();
                $("#tipoDocumento").val("Encargue");
            }

            cambioDocumento();
        });

        $(".nav-tabs .nav-item .nav-link.tipoAccion").on("click", function() {
            $(".nav-tabs .nav-item .nav-link.tipoAccion").removeClass("active");
            $(this).addClass("active");

            accion = $(".nav-tabs .nav-item .nav-link.accion.active").attr("id");
            tipoAccion = $(this).attr("id");

            $("#tipoDocumento").val(accion + tipoAccion);

            cambioDocumento();
        });

        $(".js-example-placeholder-single").select2({
            placeholder: "Select a state",
            allowClear: true
        });
    });

    function cambioDocumento() {
        tipoDocumento = $("#tipoDocumento").val();

        $("#lblCliente").hide();
        $("#filaProveedor").hide();
        $("#filaCliente").hide();
        $("#filaFormaPago").hide();
        $("#filaProductos").hide();
        $("#filaVentaNotaCredito").hide();
        $("#filaCompraNotaCredito").hide();

        switch (tipoDocumento) {
            case "VentaFactura":
                $("#filaCliente").show();
                $("#filaFormaPago").show();
                $("#filaProductos").show();
                break;
            case "CompraFactura":
                $("#filaProveedor").show();
                $("#filaFormaPago").show();
                $("#filaProductos").show();
                break;
            case "VentaNotaCredito":
                $("#filaVentaNotaCredito").show();
                break;
            case "CompraNotaCredito":
                $("#filaCompraNotaCredito").show();
                break;
            case "Encargue":
                $("#lblCliente").show();
                $("#filaCliente").show();
                $("#filaProductos").show();
                break;
        }
    }

    function cargarTallesProducto(idProducto) {
        $.ajax({
            method: "POST",
            url: "<?= Url::toRoute(['producto/obtener-talles-producto']); ?>",
            data: {
                _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                id: idProducto.split("_")[0]
            },
            success: function(result) {
                data = JSON.parse(result);
                $("#selectTallesProducto").empty();
                $("#selectTallesProducto").append("<option value=''></option>");

                for (i = 0; i < data.length; i++) {
                    $("#selectTallesProducto").append("<option value='" + data[i].id + "_" + data[i].tal_prod_tal_id + "_" + data[i].tal_prod_venta + "'>" + data[i].tal_prod_tal_id + "</option>")
                }
            },
        });
    }

    function agregarProductoCarrito() {
        producto = $("#selectProducto").val();
        talle = $("#selectTallesProducto").val();

        if (producto != "" && talle != "") {

            producto = producto.split("_");
            idProducto = producto[0];
            nombreProducto = producto[1];

            talle = talle.split("_");
            idTalle = talle[0];
            nombreTalle = talle[1];
            precioTalle = talle[2];

            $("#tablaCarrito tbody").append(`<tr>
                                            <td id="producto_` + idProducto + `">` + nombreProducto + `</td>
                                            <td id="talle_` + idTalle + `">` + nombreTalle + `</td>
                                            <td id="precio_` + idProducto + `_` + idTalle + `">` + precioTalle + `</td>
                                            <td id="cantidad_` + idProducto + `_` + idTalle + `"><input type="number" class="form-control" min="1" value="1" onchange="calcularTotales()"></input></td>
                                            <td><a href="#" onclick="$(this).closest('tr').remove();calcularTotales()"><i class="fa-solid fa-trash"></i><a/></td>
                                            </tr>`);
            calcularTotales();
        }
    }

    function calcularTotales() {

        precios = $("td[id^='precio_']");
        cantidades = $("td[id^='cantidad_'] input");

        precio = 0;
        cantidad = 0;

        for (i = 0; i < precios.length; i++) {
            precio = precio + (parseFloat(precios[i].innerHTML) * parseInt(cantidades[i].value))
            cantidad = cantidad + parseInt(cantidades[i].value);
        }

        $("#totalPrecio").text(precio);
        $("#totalCantidad").text(cantidad);
    }

    function finalizarAccion() {
        tipoDocumento = $("#tipoDocumento").val();
        cliente = $("#cliente").val();
        proveedor = $("#proveedor").val();
        formaPago = $("#formaPago").val();
        adenda = $("#adenda").val();

        switch (tipoDocumento) {
            case "VentaFactura":
                if (formaPago == "") {
                    $("#textoModalAdvertencia").empty();
                    $("#textoModalAdvertencia").append("Debe seleccionar una forma de pago");
                    $("#modalAdvertencia").modal("show");
                    break;
                }
                break;
            case "CompraFactura":
                if (proveedor == "") {
                    $("#textoModalAdvertencia").empty();
                    $("#textoModalAdvertencia").append("Debe seleccionar un proveedor");
                    $("#modalAdvertencia").modal("show");
                    break;
                }

                if (formaPago == "") {
                    $("#textoModalAdvertencia").empty();
                    $("#textoModalAdvertencia").append("Debe seleccionar una forma de pago");
                    $("#modalAdvertencia").modal("show");
                    break;
                }
                break;
            case "Encargue":
                if (cliente == "") {
                    $("#textoModalAdvertencia").empty();
                    $("#textoModalAdvertencia").append("Debe seleccionar un cliente");
                    $("#modalAdvertencia").modal("show");
                    break;
                }
                break;
        }

        filasTabla = $("#tablaCarrito").find("tr");
        datos = [];

        if (filasTabla.length <= 2 && tipoDocumento != "VentaNotaCredito" && tipoDocumento != "CompraNotaCredito") {
            $("#textoModalAdvertencia").empty();
            $("#textoModalAdvertencia").append("No hay productos en el carrito");
            $("#modalAdvertencia").modal("show");
        }

        for (i = 2; i < filasTabla.length; i++) {
            columnasFila = $(filasTabla[i]).find("td");

            idProducto = columnasFila[0].id.split("_")[1];
            idTalle = columnasFila[1].id.split("_")[1];
            precio = parseFloat($(columnasFila[2]).text());
            cantidad = parseInt($("#cantidad_" + idProducto + "_" + idTalle).val())

            fila = {
                producto: idProducto,
                talle: idTalle,
                precio: precio,
                cantidad: cantidad
            }
            datos.push(fila);
        }

        $.ajax({
            method: "POST",
            url: "<?= Url::toRoute(['venta/create']); ?>",
            data: {
                _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                tipoDocumento: tipoDocumento,
                datos: datos,
                cliente: cliente,
                proveedor: proveedor,
                formaPago: formaPago,
                adenda: adenda
            },
            success: function(result) {
                if (result == 0) {
                    location.reload();
                }
            }
        });
    }
</script>