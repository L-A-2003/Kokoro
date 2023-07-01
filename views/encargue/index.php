<?php


use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Encargues';
?>

<div class="container-fluid">
    <div class="row mt-3 align-items-center">
        <div class="col-1">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="row">
            <div class="col-12">
                <table id="tablaEncargues" class="row-border items table table-condensed hover nowrap">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Cantidad de productos</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        <tr id="filtros">
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
</div>

<div id="modalEliminarEncargue" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar encargue</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= Html::beginForm(['encargue/delete'], 'post') ?>
            <input type="hidden" name="id" id="idEncargueEliminar"></input>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col" id="textoModalEliminar">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalEliminarEncargue').modal('hide');">Cancelar</button>
                <button type="submit" class="btn btn-primary">Eliminar</button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>

<div id="modalDatosEncargue" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos del encargue</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <table id="tablaDatosEncargue" class="row-border items table table-condensed hover nowrap">
                                <thead>
                                    <th>Producto</th>
                                    <th>Talle</th>
                                    <th>Precio unitario</th>
                                    <th>Cantidad</th>
                                    <th>Descuento</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalDatosEncargue').modal('hide');">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tablaEncargues').DataTable({
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
            data: [],
            responsive: true,
            bFilter: false,
            paging: false,
            ordering: false,
            searching: true,
            columns: [{
                    data: 'cat_nombre'
                },
                {
                    data: 'cat_nombre'
                },
                {
                    data: 'cat_nombre'
                },
                {
                    data: function(data) {
                        return "<a class='me-2' onclick='datosEncargue(" + data.id + ")'><i class='fa-solid fa-plus'></i></a> <a class='' onclick='eliminarEncargue(" + data.id + ",`" + data.cat_nombre + "`)'><i class='fa-solid fa-trash'></i></a>"
                    }
                }
            ],
            initComplete: function() {
                columnas = [0];
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

    function eliminarEncargue(id, nombre) {
        $("#idEncargueEliminar").val(id);
        $("#textoModalEliminar").empty();
        $("#textoModalEliminar").append("<p>¿Desea eliminar el encargue del cliente " + nombre + "?</p>");
        $("#modalEliminarEncargue").modal("show");
    }

    function datosEncargue(id) {
        $.ajax({
            method: "POST",
            url: "<?= Url::toRoute(['encargue/obtener-encargue']); ?>",
            data: {
                _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                id: id
            },
            success: function(result) {
                data = JSON.parse(result);
                
            },
        });
    }
</script>