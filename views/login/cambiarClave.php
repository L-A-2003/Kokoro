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
                        <h1>Cambiar clave</h1>
                    </div>

                    <div class="row mt-4 justify-content-center">
                        <div class="col-6 text-center">
                            <h5>Nueva clave</h5>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-10 text-center">
                            <input type="text" id="nuevaClave" class="form-control" required></input>
                        </div>
                    </div>

                    <div class="row mt-4 justify-content-center">
                        <div class="col-6 text-center">
                            <h5>Repetir clave</h5>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-10 text-center">
                            <input type="text" id="repetirClave" class="form-control" required></input>
                        </div>
                    </div>

                    <div class="row mt-4 justify-content-center">
                        <div class="col-10 text-center d-grid gap-2">
                            <button type="submit" class="btn btn-primary" onclick="cambiarClave()">Cambiar clave</button>
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

        function cambiarClave() {
            nuevaClave = $("#nuevaClave").val();
            repetirClave = $("#repetirClave").val();

            if (nuevaClave == repetirClave) {
                $.ajax({
                    method: "POST",
                    url: "<?= Url::toRoute(['login/cambiar-clave']); ?>",
                    data: {
                        _csrf: "<?= Yii::$app->request->csrfToken; ?>",
                        clave: nuevaClave
                    },
                    success: function(result) {

                        switch (result) {
                            case "0":
                                $("#textoModalAdvertencia").empty();
                                $("#textoModalAdvertencia").append("");
                                $("#modalAdvertencia").modal("show");
                                break;
                            default:
                                //Redirigir al index
                                break;
                        }
                    },
                });
            } else {
                $("#textoModalAdvertencia").empty();
                $("#textoModalAdvertencia").append("Las claves no coinciden");
                $("#modalAdvertencia").modal("show");
            }
        }
    </script>