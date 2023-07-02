<?php


use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Clientes y proveedores';
?>

<div class="container-fluid">
    <div class="row mt-3 align-items-center">
        <div class="col-5">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col d-flex justify-content-end">
            <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalNuevoClienteProveedor'>Nuevo Cliente o proveedor</button>
        </div>

        <div class="row">
            <div class="col-12">
                <table id="tablaClientesProveedores" class="row-border items table table-condensed hover nowrap">
                    <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Correo electrónico</th>
                            <th>Departamento</th>
                            <th>Ciudad</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
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
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="modalNuevoClienteProveedor" class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Cliente o proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <?= Html::beginForm(['cliente-proveedor/create'], 'post') ?>
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Tipo:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <select name="tipo" class="form-control" onchange="clienteProveedor('filaCrearApellido', 'crearApellido', this.value)" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="false">Cliente</option>
                                    <option value="true">Proveedor</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Documento:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <input name="documento" type="text" placeholder="Documento" class="form-control" required></input>
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

                        <div class="row mt-3 justify-content-center" id="filaCrearApellido">
                            <div class="col-3 text-end">
                                <label>Apellido:<span class="text-danger">*<span></label>
                            </div>
                            <div class="col">
                                <input id="crearApellido" name="apellido" type="text" placeholder="Apellido" class="form-control" required></input>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Correo:</label>
                            </div>
                            <div class="col">
                                <input name="correo" type="text" placeholder="Correo" class="form-control"></input>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Departamento:</label>
                            </div>
                            <div class="col">
                                <select name="departamento" class="form-control">
                                    <option value="">Seleccione una opción</option>
                                    <option value="Artigas">Artigas</option>
                                    <option value="Canelones">Canelones</option>
                                    <option value="Cerro Largo">Cerro Largo</option>
                                    <option value="Colonia">Colonia</option>
                                    <option value="Durazno">Durazno</option>
                                    <option value="Flores">Flores</option>
                                    <option value="Florida">Florida</option>
                                    <option value="Lavalleja">Lavalleja</option>
                                    <option value="Maldonado">Maldonado</option>
                                    <option value="Montevideo">Montevideo</option>
                                    <option value="Paysandú">Paysandú</option>
                                    <option value="Río Negro">Río Negro</option>
                                    <option value="Rivera">Rivera</option>
                                    <option value="Rocha">Rocha</option>
                                    <option value="Salto">Salto</option>
                                    <option value="San José">San José</option>
                                    <option value="Soriano">Soriano</option>
                                    <option value="Tacuarembó">Tacuarembó</option>
                                    <option value="Treinta y Tres">Treinta y Tres</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Ciudad:</label>
                            </div>
                            <div class="col">
                                <input name="ciudad" type="text" placeholder="Ciudad" class="form-control"></input>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Dirección:</label>
                            </div>
                            <div class="col">
                                <input name="direccion" type="text" placeholder="Dirección" class="form-control"></input>
                            </div>
                        </div>

                        <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Teléfono:</label>
                            </div>
                            <div class="col">
                                <input name="telefono" type="text" placeholder="Teléfono" class="form-control"></input>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="$('#modalNuevoClienteProveedor').modal('hide');">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </div>
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>

<div id="modalEditarClienteProveedor" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Cliente o proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= Html::beginForm(['cliente-proveedor/update'], 'post') ?>
            <input name="id" id="editarId" type="text" class="form-control" hidden></input>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Tipo:<span class="text-danger">*<span></label>
                        </div>
                        <div class="col">
                            <select id="editarTipo" name="tipo" class="form-control" onchange="clienteProveedor('filaEditarApellido', 'editarApellido', this.value)" required>
                                <option value="">Seleccione una opción</option>
                                <option value="false">Cliente</option>
                                <option value="true">Proveedor</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Documento:<span class="text-danger">*<span></label>
                        </div>
                        <div class="col">
                            <input id="editarDocumento" name="documento" type="text" placeholder="Documento" class="form-control" required></input>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Nombre:<span class="text-danger">*<span></label>
                        </div>
                        <div class="col">
                            <input id="editarNombre" name="nombre" type="text" placeholder="Nombre" class="form-control" required></input>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center" id="filaEditarApellido">
                        <div class="col-3 text-end">
                            <label>Apellido:<span class="text-danger">*<span></label>
                        </div>
                        <div class="col">
                            <input id="editarApellido" name="apellido" type="text" placeholder="Apellido" class="form-control" required></input>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Correo:</label>
                        </div>
                        <div class="col">
                            <input id="editarCorreo" name="correo" type="text" placeholder="Correo" class="form-control"></input>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Departamento:</label>
                        </div>
                        <div class="col">
                            <select id="editarDepartamento" name="departamento" class="form-control">
                                <option value="">Seleccione una opción</option>
                                <option value="Artigas">Artigas</option>
                                <option value="Canelones">Canelones</option>
                                <option value="Cerro Largo">Cerro Largo</option>
                                <option value="Colonia">Colonia</option>
                                <option value="Durazno">Durazno</option>
                                <option value="Flores">Flores</option>
                                <option value="Florida">Florida</option>
                                <option value="Lavalleja">Lavalleja</option>
                                <option value="Maldonado">Maldonado</option>
                                <option value="Montevideo">Montevideo</option>
                                <option value="Paysandú">Paysandú</option>
                                <option value="Río Negro">Río Negro</option>
                                <option value="Rivera">Rivera</option>
                                <option value="Rocha">Rocha</option>
                                <option value="Salto">Salto</option>
                                <option value="San José">San José</option>
                                <option value="Soriano">Soriano</option>
                                <option value="Tacuarembó">Tacuarembó</option>
                                <option value="Treinta y Tres">Treinta y Tres</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Ciudad:</label>
                        </div>
                        <div class="col">
                            <input id="editarCiudad" name="ciudad" type="text" placeholder="Ciudad" class="form-control"></input>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                        <div class="col-3 text-end">
                            <label>Dirección:</label>
                        </div>
                        <div class="col">
                            <input id="editarDireccion" name="direccion" type="text" placeholder="Dirección" class="form-control"></input>
                        </div>
                    </div>

                    <div class="row mt-3 justify-content-center">
                            <div class="col-3 text-end">
                                <label>Teléfono:</label>
                            </div>
                            <div class="col">
                                <input id="editarTelefono" name="telefono" type="text" placeholder="Teléfono" class="form-control"></input>
                            </div>
                        </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalEditarClienteProveedor').modal('hide');">Cancelar</button>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>

<div id="modalEliminarClienteProveedor" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Eliminar Cliente o proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <?= Html::beginForm(['cliente-proveedor/delete'], 'post') ?>
            <input type="hidden" name="id" id="idClienteProveedorEliminar"></input>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col" id="textoModalEliminar">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" onclick="$('#modalEliminarClienteProveedor').modal('hide');">Cancelar</button>
                <button type="submit" class="btn btn-primary">Eliminar</button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#tablaClientesProveedores').DataTable({
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
            data: <?= $clientesProveedores ?>,
            responsive: true,
            bFilter: false,
            paging: false,
            ordering: false,
            searching: true,
            columns: [{
                    data: function(data) {
                        if (data.cliprov_tipo == "false") {
                            return "Cliente";
                        } else {
                            return "Proveedor";
                        }
                    }
                },
                {
                    data: "cliprov_documento"
                },
                {
                    data: "cliprov_nombre"
                },
                {
                    data: function(data) {
                        if (data.cliprov_apellido != null && data.cliprov_apellido != "") {
                            return data.cliprov_apellido;
                        } else {
                            return "-";
                        }
                    }
                },
                {
                    data: function(data) {
                        if (data.cliprov_correo != null && data.cliprov_correo != "") {
                            return data.cliprov_correo;
                        } else {
                            return "-";
                        }
                    }
                },
                {
                    data: function(data) {
                        if (data.cliprov_departamento != null && data.cliprov_departamento != "") {
                            return data.cliprov_departamento;
                        } else {
                            return "-";
                        }
                    }
                },
                {
                    data: function(data) {
                        if (data.cliprov_ciudad != null && data.cliprov_ciudad != "") {
                            return data.cliprov_ciudad;
                        } else {
                            return "-";
                        }
                    }
                },
                {
                    data: function(data) {
                        if (data.cliprov_direccion != null && data.cliprov_direccion != "") {
                            return data.cliprov_direccion;
                        } else {
                            return "-";
                        }
                    }
                },
                {
                    data: function(data) {
                        if (data.cliprov_telefono != null && data.cliprov_telefono != "") {
                            return data.cliprov_telefono;
                        } else {
                            return "-";
                        }
                    }
                },
                {
                    data: function(data) {
                        return "<a class='me-2' onclick='actualizarClienteProveedor(" + data.id + ")'><i class='fa-solid fa-pencil'></i></a><a class='' onclick='eliminarClienteProveedor(" + data.id + ",`" + data.cliprov_nombre + "`)'><i class='fa-solid fa-trash'></i></a>"
                    }
                }
            ],
            initComplete: function() {
                columnas = [0, 1, 2, 3, 4, 5, 6, 7];
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

    function eliminarClienteProveedor(id, nombre) {
        $("#idClienteProveedorEliminar").val(id);
        $("#textoModalEliminar").empty();
        $("#textoModalEliminar").append("<p>¿Desea eliminar el cliente o proveedor " + nombre + "?</p>");
        $("#modalEliminarClienteProveedor").modal("show");
    }

    function actualizarClienteProveedor(id) {
        $.ajax({
            method: "POST",
            url: "<?= Url::toRoute(['cliente-proveedor/update']); ?>",
            data: {
                _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                id: id
            },
            success: function(result) {
                data = JSON.parse(result);
                $("#editarTipo").val(data.cliprov_tipo);
                $("#editarDocumento").val(data.cliprov_documento);
                $("#editarNombre").val(data.cliprov_nombre);
                $("#editarApellido").val(data.cliprov_apellido);
                $("#editarCorreo").val(data.cliprov_correo);
                $("#editarDepartamento").val(data.cliprov_departamento);
                $("#editarCiudad").val(data.cliprov_ciudad);
                $("#editarDireccion").val(data.cliprov_direccion);
                $("#editarTelefono").val(data.cliprov_telefono);
                clienteProveedor("filaEditarApellido", "editarApellido", data.cliprov_tipo);
                $("#modalEditarClienteProveedor").modal("show");
            },
        });
    }

    function clienteProveedor(fila, campo, valor) {
        if (valor == "false") {
            $("#" + fila).show();
            $("#" + campo).prop("required", true);
        } else {
            $("#" + fila).hide();
            $("#" + campo).prop("required", false);
        }
    }
</script>