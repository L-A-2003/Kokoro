<?php


use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
?>

<style>
    .marco {
        position: absolute;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40%;
        padding: 20px;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10 justify-content-center">
            <div class="container-fluid">
                <?= Html::beginForm([''], '', ['onsubmit' => 'event.preventDefault()']) ?>
                <div class="row justify-content-center">
                    <div class="col-10 text-center">
                        <h1>Iniciar Sesión</h1>
                    </div>

                    <div class="row mt-4 justify-content-center">
                        <div class="col-3 text-center">
                            <h5>Usuario</h5>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-10 text-center">
                            <input type="text" id="usuario" class="form-control" required></input>
                        </div>
                    </div>

                    <div class="row mt-4 justify-content-center">
                        <div class="col-3 text-center">
                            <h5>Clave</h5>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-10 text-center">
                            <input type="text" id="clave" class="form-control" required></input>
                        </div>
                    </div>

                    <div class="row mt-4 justify-content-center">
                        <div class="col-10 text-center d-grid gap-2">
                            <button type="submit" class="btn btn-primary" onclick="login()">Iniciar sesión</button>
                        </div>
                    </div>
                    <?= Html::endForm() ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            //$("#navbar").hide();
        });

        function login() {
            usuario = $("#usuario").val();
            clave = $("#clave").val();

            $.ajax({
                method: "POST",
                url: "<?= Url::toRoute(['login/login']); ?>",
                data: {
                    _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                    usuario: usuario,
                    clave: clave
                },
                success: function(result) {

                    switch (result) {
                        case "0":
                            $("#textoModalAdvertencia").empty();
                            $("#textoModalAdvertencia").append("El usuario no existe");
                            $("#modalAdvertencia").modal("show");
                            break;
                        case "1":
                            $("#textoModalAdvertencia").empty();
                            $("#textoModalAdvertencia").append("Clave incorrecta");
                            $("#modalAdvertencia").modal("show");
                            break;
                        default:
                            localStorage.setItem("token", result);
                            //Redirigir al index
                            break;
                    }
                },
            });
        }
    </script>