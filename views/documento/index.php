<?php


use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Documentos';
?>

<div class="container-fluid">
    <div class="row mt-3 align-items-center">
        <div class="col-1">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>

        <div class="row">
            <div class="col-12">
                <table id="tablaDocumentos" class="row-border items table table-condensed hover nowrap">
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

<div id="modalDatosDocumento" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Datos del documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <table id="tablaDatosDocumento" class="row-border items table table-condensed hover nowrap">
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
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalDatosDocumento').modal('hide');">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tablaDocumentos').DataTable({
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
                        return "<a class='me-2' onclick='datosDocumento(" + data.id + ")'><i class='fa-solid fa-plus'></i></a>"
                    }
                }
            ],
            initComplete: function() {
                columnas = [0, 1, 2];
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

    function datosDocumento(id) {
        $.ajax({
            method: "POST",
            url: "<?= Url::toRoute(['documento/obtener-documento']); ?>",
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