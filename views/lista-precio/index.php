<?php


use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Listas de precios';
?>

<div class="container-fluid">
    <div class="row mt-3 align-items-center">
        <div class="col-4">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col d-flex justify-content-end">
            <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalNuevoListaPrecio'>Nueva lista de precio</button>
        </div>

        <div class="row">
            <div class="col-12">
                <table id="tablaListasPrecios" class="row-border items table table-condensed hover nowrap">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Temporada</th>
                            <th>Categoría</th>
                            <th>Porcentaje de modificación</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                            <th></th>
                        </tr>
                        <tr id="filtros">
                            <th></th>
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

    <div id="modalNuevoListaPrecio" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Nueva lista de precio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?= Html::beginForm(['lista-precio/create'], 'post', ['onsubmit' => 'return validarFecha("C")']) ?>
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Nombre:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <input name="nombre" type="text" placeholder="Nombre" class="form-control" required></input>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Temporada:</label>
                            </div>
                            <div class="col">
                                <select name="temporada" type="text" class="form-control">
                                    <option value="">Seleccione una temporada</option>
                                    <?php foreach ($temporadas as $temporada) {  ?>
                                        <option value="<?= $temporada->id ?>"><?= $temporada->temp_nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Categoría:</label>
                            </div>
                            <div class="col">
                                <select name="categoria" type="text" class="form-control">
                                    <option value="">Seleccione una categoría</option>
                                    <?php foreach ($categorias as $categoria) {  ?>
                                        <option value="<?= $categoria->id ?>"><?= $categoria->cat_nombre ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label> Porcentaje:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col input-group">
                                <input name="porcentaje" type="text" placeholder="Porcentaje" class="form-control" required aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label> Desde:</label>
                            </div>
                            <div class="col">
                                <input id="crearDesde" name="desde" type="date" class="form-control">
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label> Hasta:</label>
                            </div>
                            <div class="col">
                                <input id="crearHasta" name="hasta" type="date" class="form-control">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="$('#modalNuevoListaPrecio').modal('hide');">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>

<div id="modalEditarListaPrecio" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar lista de precio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= Html::beginForm(['lista-precio/update'], 'post', ['onsubmit' => 'return validarFecha("E")']) ?>
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
                            <label>Categoría:</label>
                        </div>
                        <div class="col">
                            <select name="categoria" id="editarCategoria" type="text" class="form-control">
                                <option value="">Seleccione una categoría</option>
                                <?php foreach ($categorias as $categoria) {  ?>
                                    <option value="<?= $categoria->id ?>"><?= $categoria->cat_nombre ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label> Porcentaje:<span class="text-danger">*<span></label>
                        </div>
                        <div class="col input-group">
                            <input name="porcentaje" id="editarPorcentaje" type="text" placeholder="Porcentaje" class="form-control" required aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label> Desde:</label>
                        </div>
                        <div class="col">
                            <input id="editarDesde" name="desde" type="date" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label> Hasta:</label>
                        </div>
                        <div class="col">
                            <input id="editarHasta" name="hasta" type="date" class="form-control">
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalEditarListaPrecio').modal('hide');">Cancelar</button>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>

<div id="modalEliminarListaPrecio" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar lista de precio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= Html::beginForm(['lista-precio/delete'], 'post') ?>
            <input type="hidden" name="id" id="idListaPrecioEliminar"></input>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col" id="textoModalEliminar">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalEliminarListaPrecio').modal('hide');">Cancelar</button>
                <button type="submit" class="btn btn-primary">Eliminar</button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#tablaListasPrecios').DataTable({
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
            data: <?= $listasPrecios ?>,
            responsive: true,
            bFilter: false,
            paging: false,
            ordering: false,
            searching: true,
            columns: [{
                    data: 'list_nombre'
                },
                {
                    data: function(data) {
                        if (data.list_temporada != null) {
                            return data.list_temporada;
                        } else {
                            return "-";
                        }
                    }
                },
                {
                    data: function(data) {
                        if (data.list_categoria != null) {
                            return data.list_categoria;
                        } else {
                            return "-";
                        }
                    }
                },
                {
                    data: function(data) {
                        return data.list_porcentaje_modificacion + "%";
                    }
                },
                {
                    data: function(data) {
                        if (data.list_desde != null) {
                            return data.list_desde;
                        } else {
                            return "-";
                        }
                    }
                },
                {
                    data: function(data) {
                        if (data.list_hasta != null) {
                            return data.list_hasta;
                        } else {
                            return "-";
                        }
                    }
                },
                {
                    data: function(data) {
                        return "<a class='me-2' onclick='actualizarListaPrecio(" + data.id + ")'><i class='fa-solid fa-pencil'></i></a><a class='' onclick='eliminarListaPrecio(" + data.id + ",`" + data.list_nombre + "`)'><i class='fa-solid fa-trash'></i></a>"
                    }
                }
            ],
            initComplete: function() {
                columnas = [0, 1, 2, 3, 4, 5];
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
    });

    function eliminarListaPrecio(id, nombre) {
        $("#idListaPrecioEliminar").val(id);
        $("#textoModalEliminar").empty();
        $("#textoModalEliminar").append("<p>¿Desea eliminar la lista de precio " + nombre + "?</p>");
        $("#modalEliminarListaPrecio").modal("show");
    }

    function actualizarListaPrecio(id) {
        $.ajax({
            method: "POST",
            url: "<?= Url::toRoute(['lista-precio/update']); ?>",
            data: {
                _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                id: id
            },
            success: function(result) {
                data = JSON.parse(result);
                $("#editarNombre").val(data.list_nombre);
                $("#editarTemporada").val(data.list_temporada);
                $("#editarPorcentaje").val(data.list_porcentaje_modificacion);
                $("#modalEditarListaPrecio").modal("show");
            },
        });
    }

    function validarFecha(form) {
        if (form == 'C') {
            desde = $("#crearDesde").val();
            hasta = $("#crearHasta").val();
            modal = "#modalNuevoListaPrecio";
        } else {
            desde = $("#editarDesde").val();
            hasta = $("#editarHasta").val();
            modal = "#modalEditarListaPrecio";
        }

        if ((desde != "" && hasta == "") || (desde == "" && hasta != "")) {
            $("#textoModalAdvertencia").empty();
            $("#textoModalAdvertencia").append("Ambos campos de fecha deben estar rellenos o vacíos");
            $(modal).modal("hide");
            $("#modalAdvertencia").modal("show");
            $("#btnAdvertencia").on('click', function() {
                $("#modalAdvertencia").modal("hide");
                $(modal).modal("show")
            });
            return false;
        } else {
            if (desde > hasta) {
                $("#textoModalAdvertencia").empty();
                $("#textoModalAdvertencia").append("La fecha 'Desde' es menor a la fecha 'Hasta'");
                $(modal).modal("hide");
                $("#modalAdvertencia").modal("show");
                $("#btnAdvertencia").on('click', function() {
                    $("#modalAdvertencia").modal("hide");
                    $(modal).modal("show")
                });
                return false;
            } else {
                return true;
            }
        }
    }
</script>

<script type="text/javascript" charset="utf-8">
    $(function() {
        $('input[name=porcentaje]').number(true, 2, '.', ',');
    });
</script>