<?php


use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Temporadas';
?>

<div class="container-fluid">
    <div class="row mt-3 align-items-center">
        <div class="col-1">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col d-flex justify-content-end">
            <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalNuevaTemporada'>Nueva temporada</button>
        </div>

        <div class="row">
            <div class="col-12">
                <table id="tablaTemporadas" class="row-border items table table-condensed hover nowrap">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                        <tr id="filtros">
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="modalNuevaTemporada" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Nueva temporada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?= Html::beginForm(['temporada/create'], 'post') ?>
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

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="$('#modalNuevaTemporada').modal('hide');">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>

<div id="modalEditarTemporada" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar temporada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= Html::beginForm(['temporada/update'], 'post') ?>
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

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalEditarTemporada').modal('hide');">Cancelar</button>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>

<div id="modalEliminarTemporada" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar temporada</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= Html::beginForm(['temporada/delete'], 'post') ?>
            <input type="hidden" name="id" id="idTemporadaEliminar"></input>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col" id="textoModalEliminar">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalEliminarTemporada').modal('hide');">Cancelar</button>
                <button type="submit" class="btn btn-primary">Eliminar</button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#tablaTemporadas').DataTable({
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
            data: <?= $temporadas ?>,
            responsive: true,
            bFilter: false,
            paging: false,
            ordering: false,
            columns: [{
                    data: 'temp_nombre'
                },
                {
                    data: function(data) {
                        return "<a class='me-2' onclick='actualizarTemporada(" + data.id + ")'><i class='fa-solid fa-pencil'></i></a><a class='' onclick='eliminarTemporada(" + data.id + ",`" + data.temp_nombre + "`)'><i class='fa-solid fa-trash'></i></a>"
                    }
                }
            ],
            initComplete: function() {
                this.api().columns(0).every(function() {
                    columna = this;
                    
                    $('<input type="text" class="form-control"/>').appendTo($("#filtros").find("th").eq(columna.index())).on('keyup change', function() {
                        if (columna.search() !== this.value) {
                            columna.search(this.value).draw();
                        }
                    });
                });
            }
        });
    });

    function eliminarTemporada(id, nombre) {
        $("#idTemporadaEliminar").val(id);
        $("#textoModalEliminar").empty();
        $("#textoModalEliminar").append("<p>¿Desea eliminar la temporada " + nombre + "?</p>");
        $("#modalEliminarTemporada").modal("show");
    }

    function actualizarTemporada(id) {
        $.ajax({
            method: "POST",
            url: "<?= Url::toRoute(['temporada/update']); ?>",
            data: {
                _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                id: id
            },
            success: function(result) {
                data = JSON.parse(result);
                $("#editarNombre").val(data.temp_nombre);
                $("#modalEditarTemporada").modal("show");
            },
        });
    }
</script>