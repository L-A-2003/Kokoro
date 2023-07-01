<?php


use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Productos';
?>

<style>
    #modalPreciosNuevoProducto .modal-content,
    #modalActualizarPreciosProducto .modal-content {
        width: 200%;
        margin-left: -50%;
    }

    #tablaPreciosProducto,
    #tablaActualizarPreciosProducto {
        width: 100% !important;
    }
</style>

<div class="container-fluid">
    <div class="row mt-3 align-items-center">
        <div class="col-1">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col d-flex justify-content-end">
            <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalNuevoProducto'>Nuevo producto</button>
        </div>

        <div class="row">
            <div class="col-12">
                <table id="tablaProductos" class="row-border items table table-condensed hover nowrap">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Genero</th>
                            <th>Temporada</th>
                            <th>Lista de precios</th>
                            <th></th>
                        </tr>
                        <tr id="filtros">
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="modalNuevoProducto" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Nuevo producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Nombre:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <input name="nombre" id="nuevoNombre" type="text" placeholder="Nombre" class="form-control obligatorio"></input>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Categoría:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <select name="categoria" id="nuevoCategoria" type="text" class="form-control obligatorio">
                                    <option value="">Seleccione una categoría</option>
                                    <?php foreach ($categorias as $categoria) {  ?>
                                        <option value="<?= $categoria->id ?>"><?= $categoria->cat_nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Género:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <select name="genero" id="nuevoGenero" type="text" class="form-control obligatorio">
                                    <option value="">Seleccione un género</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                    <option value="U">Unisex</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Temporada:</label>
                            </div>
                            <div class="col">
                                <select name="temporada" id="nuevoTemporada" type="text" class="form-control">
                                    <option value="">Seleccione una temporada</option>
                                    <?php foreach ($temporadas as $temporada) {  ?>
                                        <option value="<?= $temporada->id ?>"><?= $temporada->temp_nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Lista de precios:</label>
                            </div>
                            <div class="col">
                                <select name="listaPrecio" id="nuevoListaPrecio" type="text" class="form-control">
                                    <option value="">Seleccione una lista de precios</option>
                                    <?php foreach ($listasPrecios as $listaPrecios) {  ?>
                                        <option value="<?= $listaPrecios->id ?>"><?= $listaPrecios->list_nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Etiquetas:</label>
                            </div>
                            <div class="col">
                                <input name="etiquetas" id="nuevoEtiquetas" type="text" placeholder="Etiquetas" class="form-control"></input>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="$('#modalNuevoProducto').modal('hide');">Cancelar</button>
                    <button type="submit" id="btnSiguiente" class="btn btn-primary" onclick="$('#modalNuevoProducto').modal('hide');$('#modalPreciosNuevoProducto').modal('show');" disabled>Siguiente</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalEditarProducto" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= Html::beginForm(['producto/update'], 'post') ?>
            <input name="id" id="editarId" type="text" class="form-control" hidden></input>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Nombre:<span class="text-danger">*<span></label>
                        </div>
                        <div class="col">
                            <input name="nombre" id="editarNombre" type="text" placeholder="Nombre" class="form-control" required></input>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Categoría:<span class="text-danger">*<span></label>
                        </div>
                        <div class="col">
                            <select name="categoria" id="editarCategoria" type="text" class="form-control" required>
                                <option value="">Seleccione una categoría</option>
                                <?php foreach ($categorias as $categoria) {  ?>
                                    <option value="<?= $categoria->id ?>"><?= $categoria->cat_nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Género:<span class="text-danger">*<span></label>
                        </div>
                        <div class="col">
                            <select name="genero" id="editarGenero" type="text" class="form-control" required>
                                <option value="">Seleccione un género</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                                <option value="U">Unisex</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Temporada:</label>
                        </div>
                        <div class="col">
                            <select name="temporada" id="editarTemporada" type="text" class="form-control">
                                <option value="">Seleccione una temporada</option>
                                <?php foreach ($temporadas as $temporada) {  ?>
                                    <option value="<?= $temporada->id ?>"><?= $temporada->temp_nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Lista de precios:</label>
                        </div>
                        <div class="col">
                            <select name="listaPrecio" id="editarListaPrecio" type="text" class="form-control">
                                <option value="">Seleccione una lista de precios</option>
                                <?php foreach ($listasPrecios as $listaPrecios) {  ?>
                                    <option value="<?= $listaPrecios->id ?>"><?= $listaPrecios->list_nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Etiquetas:</label>
                        </div>
                        <div class="col">
                            <input name="etiquetas" id="editarEtiquetas" type="text" placeholder="Etiquetas" class="form-control"></input>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalEditarProducto').modal('hide');">Cancelar</button>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>

<div id="modalEliminarProducto" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= Html::beginForm(['producto/delete'], 'post') ?>
            <input type="hidden" name="id" id="idProductoEliminar"></input>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col" id="textoModalEliminar">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalEliminarProducto').modal('hide');">Cancelar</button>
                <button type="submit" class="btn btn-primary">Eliminar</button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>

<div id="modalPreciosNuevoProducto" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <table id="tablaPreciosProducto" class="row-border items table table-condensed hover nowrap">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Talle</th>
                                        <th>Stock</th>
                                        <th>Precio de costo</th>
                                        <th>Porcentaje de ganancia</th>
                                        <th>Precio de venta</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer d-block">
                <div class="row justify-content-between">
                    <div class="col">
                        <button type="button" class="btn btn-outline-primary" onclick="$('#modalNuevoProducto').modal('show');$('#modalPreciosNuevoProducto').modal('hide');">Atrás</button>
                    </div>
                    <div class="col text-end">
                        <button type="button" class="btn btn-outline-primary" onclick="$('#modalPreciosNuevoProducto').modal('hide');">Cancelar</button>
                        <button class="btn btn-primary" onclick="crearActualizarProducto()">Crear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalActualizarPreciosProducto" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <table id="tablaActualizarPreciosProducto" class="row-border items table table-condensed hover nowrap">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Talle</th>
                                        <th>Stock</th>
                                        <th>Precio de costo</th>
                                        <th>Porcentaje de ganancia</th>
                                        <th>Precio de venta</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer d-block">
                <div class="row justify-content-between">
                    <div class="col text-end">
                        <button type="button" class="btn btn-outline-primary" onclick="$('#modalActualizarPreciosProducto').modal('hide');">Cancelar</button>
                        <button class="btn btn-primary" onclick="crearActualizarProducto(true)">Editar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tablaProductos').DataTable({
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
            data: <?= $productos ?>,
            responsive: true,
            bFilter: false,
            paging: false,
            ordering: false,
            searching: true,
            columns: [{
                    data: 'prod_nombre'
                },
                {
                    data: 'prod_categoria'
                },
                {
                    data: 'prod_genero'
                },
                {
                    data: function(data) {
                        if (data.prod_temporada != '') {
                            return data.prod_temporada;
                        } else {
                            return "-";
                        }
                    }
                },
                {
                    data: function(data) {
                        if (data.prod_lista_precio != '') {
                            return data.prod_lista_precio;
                        } else {
                            return "-";
                        }
                    }
                },
                {
                    data: function(data) {
                        return "<a class='me-2' onclick='actualizarProducto(" + data.id + ")'><i class='fa-solid fa-pencil'></i></a><a class='' onclick='eliminarProducto(" + data.id + ",`" + data.prod_nombre + "`)'><i class='fa-solid fa-trash'></i></a> <a class='' onclick='cargarPrecios(" + data.id + ")'><i class='fa-solid fa-dollar-sign'></i></a>"
                    }
                }
            ],
            initComplete: function() {
                columnas = [0, 1, 2, 3, 4];
                this.api().columns(columnas).every(function() {
                    var columna = this;

                    $('<input type="text" class="form-control"/>').appendTo($("#filtros").find("th").eq(columna.index())).on('keyup change', function() {
                        if (columna.search() !== this.value) {
                            columna.search(this.value).draw();
                        }
                    });
                });
            }
        });

        $('#tablaPreciosProducto').DataTable({
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
            data: <?= $talles ?>,
            responsive: true,
            bFilter: false,
            paging: false,
            ordering: false,
            searching: true,
            columns: [{
                    data: function(data) {
                        return "<input class='form-check-input' type='checkbox' id='" + data.id + "' onclick='desbloquearTalle(this.id)'>";
                    }
                }, {
                    data: 'tal_nombre'
                },
                {
                    data: function(data) {
                        return "<input type='number' min='0' id='stock_" + data.id + "' value='0' class='form-control' disabled></input>";
                    }
                },
                {
                    data: function(data) {
                        return "<input type='text' id='costo_" + data.id + "' value='0.00' class='form-control calcular' disabled></input>";
                    }
                },
                {
                    data: function(data) {
                        return "<div class='input-group'><input type='text' id='ganancia_" + data.id + "' value='0.00' class='form-control calcular' aria-describedby='basic-addon2' disabled></input><div class='input-group-append'><span class='input-group-text' id='basic-addon2'>%</span></div></div>";
                    }
                },
                {
                    data: function(data) {
                        return "<input type='text' id='venta_" + data.id + "' value='0.00' class='form-control' disabled></input>";
                    }
                }
            ],
        });

        $('#tablaActualizarPreciosProducto').DataTable({
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
            data: <?= $talles ?>,
            responsive: true,
            bFilter: false,
            paging: false,
            ordering: false,
            searching: true,
            columns: [{
                    data: function(data) {
                        return "<input class='form-check-input' type='checkbox' id='actualizar_" + data.id + "' onclick='desbloquearTalle(this.id)'>";
                    }
                }, {
                    data: 'tal_nombre'
                },
                {
                    data: function(data) {
                        return "<input type='number' min='0' id='actualizar_stock_" + data.id + "' value='0' class='form-control' disabled></input>";
                    }
                },
                {
                    data: function(data) {
                        return "<input type='text' id='actualizar_costo_" + data.id + "' value='0.00' class='form-control calcular' disabled></input>";
                    }
                },
                {
                    data: function(data) {
                        return "<div class='input-group'><input type='text' id='actualizar_ganancia_" + data.id + "' value='0.00' class='form-control calcular' aria-describedby='basic-addon2' disabled></input><div class='input-group-append'><span class='input-group-text' id='basic-addon2'>%</span></div></div>";
                    }
                },
                {
                    data: function(data) {
                        return "<input type='text' id='actualizar_venta_" + data.id + "' value='0.00' class='form-control' disabled></input>";
                    }
                }
            ],
        });

        $("input[type='text']").click(function() {
            $(this).select();
        });

        $(".obligatorio").on('input', function() {
            if ($("#nuevoNombre").val() != '' && $("#nuevoCategoria").val() != '' && $("#nuevoGenero").val() != '') {
                $("#btnSiguiente").prop("disabled", false);
            } else {
                $("#btnSiguiente").prop("disabled", true);
            }
        })

        $(".calcular").on('blur', function() {
            id = this.id.split("_")[1];
            costo = parseInt($("#costo_" + id).val());
            ganancia = parseInt($("#ganancia_" + id).val());

            if (costo != 0 && ganancia != 0) {
                venta = costo * ((ganancia / 100) + 1);
                $("#venta_" + id).val(venta);
            } else {
                $("#venta_" + id).val("0.00");
            }
        })
    });

    function eliminarProducto(id, nombre) {
        $("#idProductoEliminar").val(id);
        $("#textoModalEliminar").empty();
        $("#textoModalEliminar").append("<p>¿Desea eliminar el producto " + nombre + "?</p>");
        $("#modalEliminarProducto").modal("show");
    }

    function actualizarProducto(id) {
        $.ajax({
            method: "POST",
            url: "<?= Url::toRoute(['producto/update']); ?>",
            data: {
                _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                id: id
            },
            success: function(result) {
                data = JSON.parse(result);
                $("#editarNombre").val(data.prod_nombre);
                $("#editarEtiquetas").val(data.prod_etiquetas);
                $("#editarCategoria").val(data.prod_categoria);
                $("#editarGenero").val(data.prod_genero);
                $("#editarTemporada").val(data.prod_temporada);
                $("#editarListaPrecios").val(data.prod_lista_precio);
                $("#modalEditarProducto").modal("show");
            },
        });
    }

    function desbloquearTalle(id) {

        if ($("#" + id).is(":checked")) {
            $("#stock_" + id).prop('disabled', false);
            $("#costo_" + id).prop('disabled', false);
            $("#ganancia_" + id).prop('disabled', false);
        } else {
            $("#stock_" + id).prop('disabled', true);
            $("#costo_" + id).prop('disabled', true);
            $("#ganancia_" + id).prop('disabled', true);
        }
    }

    function crearActualizarProducto(actualizarTalles = false) {
        seleccionado = false;
        nombre = $("#nuevoNombre").val();
        categoria = $("#nuevoCategoria").val();
        genero = $("#nuevoGenero").val();
        temporada = $("#nuevoTemporada").val();
        listaPrecio = $("#nuevoListaPrecio").val();
        etiquetas = $("#nuevoEtiquetas").val();
        talles = [];

        $(":checkbox:checked").each(function() {
            seleccionado = true;
            if (actualizarTalles == true) {
                id = this.id;
                stock = parseInt($("#actualizar_stock_" + this.id).val());
                costo = parseInt($("#actualizar_costo_" + this.id).val());
                ganancia = parseInt($("#actualizar_ganancia_" + this.id).val());
                venta = parseInt($("#actualizar_venta_" + this.id).val());
            } else {
                stock = parseInt($("#stock_" + this.id).val());
                costo = parseInt($("#costo_" + this.id).val());
                ganancia = parseInt($("#ganancia_" + this.id).val());
                venta = parseInt($("#venta_" + this.id).val());
            }

            if (stock == 0) {
                $("#textoModalAdvertencia").empty();
                $("#textoModalAdvertencia").append("Hay talles seleccionados con stock 0");

                $("#btnAdvertencia").on('click', function() {
                    $("#modalAdvertencia").modal("hide");
                    $("#modalPreciosNuevoProducto").modal("show")
                })

                $("#modalPreciosNuevoProducto").modal("hide");
                $("#modalAdvertencia").modal("show");
                return;
            }

            if (venta == 0) {
                $("#textoModalAdvertencia").empty();
                $("#textoModalAdvertencia").append("Hay talles seleccionados con precio de venta 0");

                $("#btnAdvertencia").on('click', function() {
                    $("#modalAdvertencia").modal("hide");
                    $("#modalPreciosNuevoProducto").modal("show")
                })

                $("#modalPreciosNuevoProducto").modal("hide");
                $("#modalAdvertencia").modal("show");
                return;
            }

            talle = {
                id: parseInt(this.id),
                stock: stock,
                costo: costo,
                ganancia: ganancia,
                venta: venta
            }
            talles.push(talle);
        });

        if (seleccionado == true) {

            if (actualizarTalles == true) {
                $.ajax({
                    method: "POST",
                    url: "<?= Url::toRoute(['producto/update-talles']); ?>",
                    data: {
                        _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                        id: id,
                        talles: talles
                    },
                    success: function(result) {
                        location.reload();
                    }
                });
            } else {
                $.ajax({
                    method: "POST",
                    url: "<?= Url::toRoute(['producto/create']); ?>",
                    data: {
                        _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                        nombre: nombre,
                        categoria: categoria,
                        genero: genero,
                        temporada: temporada,
                        listaPrecio: listaPrecio,
                        etiquetas: etiquetas,
                        talles: talles
                    },
                    success: function(result) {
                        location.reload();
                    }
                });
            }
        } else {
            $("#textoModalAdvertencia").empty();
            $("#textoModalAdvertencia").append("No hay talles seleccionados");

            $("#btnAdvertencia").on('click', function() {
                $("#modalAdvertencia").modal("hide");
                $("#modalPreciosNuevoProducto").modal("show")
            })

            $("#modalPreciosNuevoProducto").modal("hide");
            $("#modalAdvertencia").modal("show");
        }
    }

    function cargarPrecios(id) {
        $.ajax({
            method: "POST",
            url: "<?= Url::toRoute(['producto/update-talles']); ?>",
            data: {
                _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                id: id
            },
            success: function(result) {
                data = JSON.parse(result);

                $("input[id^='actualizar_']").prop("checked", false);
                $("input[id^='actualizar_']").val("0.00");
                $("input[id^='actualizar_stock']").val("0");

                for (i = 0; i < data.length; i++) {
                    $("#actualizar_" + data[i].tal_prod_tal_id).prop("checked", true);
                    $("#actualizar_stock_" + data[i].tal_prod_tal_id).val(data[i].tal_prod_stock);
                    $("#actualizar_costo_" + data[i].tal_prod_tal_id).val(data[i].tal_prod_costo);
                    $("#actualizar_ganancia_" + data[i].tal_prod_tal_id).val(data[i].tal_prod_ganancia);
                    $("#actualizar_venta_" + data[i].tal_prod_tal_id).val(data[i].tal_prod_venta);

                    $("#actualizar_stock_" + data[i].tal_prod_tal_id).prop('disabled', false);
                    $("#actualizar_costo_" + data[i].tal_prod_tal_id).prop('disabled', false);
                    $("#actualizar_ganancia_" + data[i].tal_prod_tal_id).prop('disabled', false);
                }
                $("#modalActualizarPreciosProducto").modal("show");
            }
        });
    }
</script>

<script type="text/javascript" charset="utf-8">
    $(function() {
        $('input[id^=costo_]').number(true, 2, '.', ',');
        $('input[id^=ganancia_]').number(true, 2, '.', ',');
    });
</script>