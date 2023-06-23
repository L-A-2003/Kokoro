<?php


use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Usuarios';
?>

<div class="container-fluid">
    <div class="row mt-3 align-items-center">
        <div class="col-1">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col d-flex justify-content-end">
            <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalNuevoUsuario'>Nuevo usuario</button>
        </div>

        <div class="row">
            <div class="col-12">
                <table id="tablaUsuarios" class="row-border items table table-condensed hover nowrap">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
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

    <div id="modalNuevoUsuario" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Nuevo usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?= Html::beginForm(['usuario/create'], 'post') ?>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Usuario:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <input name="usuario" type="text" placeholder="Usuario" class="form-control" required></input>
                            </div>
                        </div>

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
                                <label>Tipo:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <select name="tipo" type="text" class="form-control" required>
                                    <option value="1">Administrador</option>
                                    <option value="2">Vendedor</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-3 text-end">
                                <label>Roles:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="facturar" name="facturar">
                                    <label class="form-check-label" for="facturar">
                                        Facturar
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="2" id="comprar" name="comprar">
                                    <label class="form-check-label" for="comprar">
                                        Comprar
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3"></div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="3" id="vender" name="vender">
                                    <label class="form-check-label" for="vender">
                                        Vender
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="4" id="crearCliente" name="crearCliente">
                                    <label class="form-check-label" for="crearCliente">
                                        Crear cliente
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="$('#modalNuevoUsuario').modal('hide');">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>

    <div id="modalEditarUsuario" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?= Html::beginForm(['usuario/update'], 'post') ?>
                <input name="id" id="editarId" type="text" class="form-control" hidden></input>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Usuario:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <input name="usuario" id="editarUsuario" type="text" placeholder="Usuario" class="form-control" required></input>
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
                                <label>Tipo:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <select name="tipo" id="editarTipo" type="text" class="form-control" required>
                                    <option value="1">Administrador</option>
                                    <option value="2">Vendedor</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-3 text-end">
                                <label>Roles:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="editarFacturar" name="facturar">
                                    <label class="form-check-label" for="editarFacturar">
                                        Facturar
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="2" id="editarComprar" name="comprar">
                                    <label class="form-check-label" for="editarComprar">
                                        Comprar
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3"></div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="3" id="editarVender" name="vender">
                                    <label class="form-check-label" for="editarVender">
                                        Vender
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="4" id="EditarCrearCliente" name="crearCliente">
                                    <label class="form-check-label" for="EditarCrearCliente">
                                        Crear cliente
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="$('#modalEditarUsuario').modal('hide');">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>

    <div id="modalEliminarUsuario" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?= Html::beginForm(['usuario/delete'], 'post') ?>
                <input type="hidden" name="id" id="idUsuarioEliminar"></input>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col" id="textoModalEliminar">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="$('#modalEliminarUsuario').modal('hide');">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('#tablaUsuarios').DataTable({
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
            data: <?= $usuarios ?>,
            responsive: true,
            bFilter: false,
            paging: false,
            ordering: false,
            columns: [{
                    data: 'usu_usuario'
                },
                {
                    data: 'usu_nombre'
                },
                {
                    data: 'usu_tipo'
                },
                {
                    data: function(data) {
                        return "<a class='me-2' onclick='actualizarUsuario(" + data.id + ")'><i class='fa-solid fa-pencil'></i></a><a class='' onclick='eliminarUsuario(" + data.id + ",`" + data.usu_nombre + "`)'><i class='fa-solid fa-trash'></i></a>"
                    }
                }
            ],
            initComplete: function() {
                columnas = [0, 1, 2];
                this.api().columns(columnas).every(function() {
                    columna = this;
                    switch (columna.index()) {
                        case 0:
                        case 1:

                            $('<input type="text" class="form-control"/>').appendTo($("#filtros").find("th").eq(columna.index())).on('keyup change', function() {
                                if (columna.search() !== this.value) {
                                    columna.search(this.value).draw();
                                }
                            });
                            break;
                        case 2:
                            $(`<select class="form-control">
                            <option value=""></option>
                            <option value="Administrador">Administrador</option>
                            <option value="Vendedor">Vendedor</option>
                            </select>
                            `).appendTo($("#filtros").find("th").eq(columna.index())).on('select', function() {
                                if (columna.search() !== this.value) {
                                    columna.search(this.value).draw();
                                }
                            });
                            break;
                    }
                });
            }
        });
    });

    function eliminarUsuario(id, nombre) {
        $("#idUsuarioEliminar").val(id);
        $("#textoModalEliminar").empty();
        $("#textoModalEliminar").append("<p>¿Desea eliminar el usuario " + nombre + "?</p>");
        $("#modalEliminarUsuario").modal("show");
    }

    function actualizarUsuario(id) {
        $.ajax({
            method: "POST",
            url: "<?= Url::toRoute(['usuario/update']); ?>",
            data: {
                _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                id: id
            },
            success: function(result) {
                data = JSON.parse(result);
                $("#editarUsuario").val(data.usu_usuario);
                $("#editarNombre").val(data.usu_nombre);
                $("#editarTipo").val(data.usu_tipo);
                //Faltan los roles

                $("#modalEditarUsuario").modal("show");
            },
        });
    }
</script>