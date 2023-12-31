<?php


use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Vendedores';
?>

<div class="container-fluid">
    <div class="row mt-3 align-items-center">
        <div class="col-1">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col d-flex justify-content-end">
            <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalNuevoVendedor'>Nuevo vendedor</button>
        </div>

        <div class="row">
            <div class="col-12">
                <table id="tablaVendedores" class="row-border items table table-condensed hover nowrap">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Comisión</th>
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

    <div id="modalNuevoVendedor" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Nuevo vendedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?= Html::beginForm(['vendedor/create'], 'post', ['onsubmit' => 'event.preventDefault()', 'id' => 'formCreate']) ?>
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Usuario:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <input id="nick" name="nick" type="text" placeholder="Usuario" class="form-control" required></input>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Nombre:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <input id="nombre" name="nombre" type="text" placeholder="Nombre" class="form-control" required></input>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Comisión:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col input-group">
                                <input id="comision" name="comision" type="text" placeholder="Comisión" class="form-control" required aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-3 text-end">
                                    <label>Clave:<span class="text-danger">*<span></label>
                                </div>
                                <div class="col">
                                    <input id="clave" name="clave" type="text" placeholder="Clave" class="form-control" required></input>
                                </div>
                            </div>

                            <div class="row mt-3 justify-content-center">
                                <div class="col-3 text-end">
                                    <label>Repetir clave:<span class="text-danger">*<span></label>
                                </div>
                                <div class="col">
                                    <input id="repetirClave" type="text" placeholder="Repetir clave" class="form-control" required></input>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="$('#modalNuevoVendedor').modal('hide');">Cancelar</button>
                    <button type="submit" class="btn btn-primary" onclick="verificarClaves()">Crear</button>
                </div>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>

<div id="modalEditarVendedor" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar vendedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= Html::beginForm(['vendedor/update'], 'post') ?>
            <input name="id" id="editarId" type="text" class="form-control" hidden></input>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Usuario:<span class="text-danger">*<span></label>
                        </div>
                        <div class="col">
                            <input name="nick" id="editarNick" type="text" placeholder="Usuario" class="form-control" required></input>
                        </div>
                    </div>

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
                            <label>Comisión:<span class="text-danger">*<span></label>
                        </div>

                        <div class="col input-group">
                            <input name="comision" id="editarComision" type="text" placeholder="Comisión" class="form-control" required aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalEditarVendedor').modal('hide');">Cancelar</button>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>

<div id="modalEliminarVendedor" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar vendedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= Html::beginForm(['vendedor/delete'], 'post') ?>
            <input type="hidden" name="id" id="idVendedorEliminar"></input>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col" id="textoModalEliminar">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalEliminarVendedor').modal('hide');">Cancelar</button>
                <button type="submit" class="btn btn-primary">Eliminar</button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#tablaVendedores').DataTable({
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
            data: <?= $vendedores ?>,
            responsive: true,
            bFilter: false,
            paging: false,
            ordering: false,
            searching: true,
            columns: [{
                    data: 'ven_nick'
                },
                {
                    data: 'ven_nombre'
                },
                {
                    data: function(data) {
                        return data.ven_comision + "%";
                    }
                },
                {
                    data: function(data) {
                        return "<a class='me-2' onclick='actualizarVendedor(" + data.id + ")'><i class='fa-solid fa-pencil'></i></a><a class='' onclick='eliminarVendedor(" + data.id + ",`" + data.ven_nombre + "`)'><i class='fa-solid fa-trash'></i></a>"
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

    function eliminarVendedor(id, nombre) {
        $("#idVendedorEliminar").val(id);
        $("#textoModalEliminar").empty();
        $("#textoModalEliminar").append("<p>¿Desea eliminar el vendedor " + nombre + "?</p>");
        $("#modalEliminarVendedor").modal("show");
    }

    function actualizarVendedor(id) {
        $.ajax({
            method: "POST",
            url: "<?= Url::toRoute(['vendedor/update']); ?>",
            data: {
                _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                id: id
            },
            success: function(result) {
                data = JSON.parse(result);
                $("#editarNick").val(data.ven_nick);
                $("#editarNombre").val(data.ven_nombre);
                $("#editarComision").val(data.ven_comision);

                $("#modalEditarVendedor").modal("show");
            },
        });
    }

    function verificarClaves() {
        clave = $("#clave").val();
        repetirClave = $("#repetirClave").val();

        if (clave == repetirClave) {

            nick = $("#nick").val();
            nombre = $("#nombre").val();
            comision = $("#comision").val();

            $.ajax({
                method: "POST",
                url: "<?= Url::toRoute(['vendedor/create']); ?>",
                data: {
                    _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                    nick: nick,
                    nombre: nombre,
                    comision: comision,
                    clave: clave
                },
                success: function(result) {
                    location.reload();
                },
            });
        } else {

            $("#btnAdvertencia").on('click', function() {
                $("#modalAdvertencia").modal("hide");
                $("#modalNuevoVendedor").modal("show")
            })

            $("#modalNuevoVendedor").modal("hide");
            $("#textoModalAdvertencia").empty();
            $("#textoModalAdvertencia").append("Las claves no coinciden");
            $("#modalAdvertencia").modal("show");
        }
    }
</script>

<script type="text/javascript" charset="utf-8">
    $(function() {
        $('input[name=comision]').number(true, 2, '.', ',');
    });
</script>