<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\widgets\Alert;
use yii\bootstrap5\Html;
use yii\helpers\Url;

$session = Yii::$app->session;
$invitado = empty(Yii::$app->session->get('usuario'));

if (!$invitado) {
    $usuario = $session->get('usuario');
    $tipo = $session->get('tipo');
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<script src="https://kit.fontawesome.com/663d89665d.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="../pluginsJquery/jquery.number.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

<style>
    .marco {
        margin: 1%;
        background-color: #fde7a5;
        border-radius: 10px;
    }

    body {
        background-color: white;
    }

    ::-webkit-scrollbar {
        width: 5px;
    }

    ::-webkit-scrollbar-track {
        background: #fff7f0;
    }

    ::-webkit-scrollbar-thumb {
        background: #DFA67B;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #de9157;
    }

    .navbar {
        background-color: #DFA67B;
    }

    .navbar-nav .nav-item .nav-link {
        color: black;
    }

    .btn-primary {
        background-color: #DFA67B;
        color: #FFF2CC;
        border: 0px;
    }

    .btn-primary:hover,
    .btn-primary:active {
        background-color: #de9157 !important;
        color: #fde7a5 !important;
    }

    .btn-outline-primary {
        color: #DFA67B;
        border-color: #DFA67B;
    }

    .btn-outline-primary:hover {
        background-color: #DFA67B;
        border-color: #DFA67B;
        color: #fde7a5;
    }

    h1 {
        color: #DFA67B;
    }

    i {
        color: #DFA67B;
    }

    .fa-cart-plus {
        color: #fde7a5;
    }

    .form-control,
    .select2-selection {
        background-color: #fff7f0 !important;
    }

    .modal-header,
    .modal-footer {
        background-color: #fde7a5;
    }

    .modal-header h5 {
        color: #DFA67B;
    }

    .modal-body {
        background-color: #fff7f0;
    }

    .nav-tabs .nav-item a {
        color: black;
    }

    .nav-tabs .nav-item .active {
        background-color: #fde7a5;
        border-color: #DFA67B;
        border-bottom-color: #fde7a5;
        color: #DFA67B;
    }

    .nav-tabs {
        border-color: #DFA67B;
    }

    .nav-link:hover {
        border-color: #DFA67B !important;
    }

    .dataTables_filter {
        display: none;
    }

    .encabezadoTabla{
        width:14%;
    }
</style>

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-dark" id="navbar">
            <a class="navbar-brand ms-3" href="<?= Url::toRoute(['site/index']); ?>">
                <img src="../imagenes/kokoro.png" width="100" height="24">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent #navEnd" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
                <?php if (!$invitado) { ?>
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= Url::toRoute(['temporada/index']); ?>">Temporadas</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= Url::toRoute(['talle/index']); ?>">Talles</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= Url::toRoute(['categoria/index']); ?>">Categorías</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= Url::toRoute(['producto/index']); ?>">Productos</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= Url::toRoute(['cliente-proveedor/index']); ?>">Clientes y proveedores</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= Url::toRoute(['encargue/index']); ?>">Encargues</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= Url::toRoute(['documento/index']); ?>">Documentos</a>
                        </li>
                        <?php if ($tipo == 'Administrador') { ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="<?= Url::toRoute(['vendedor/index']); ?>">Vendedores</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="<?= Url::toRoute(['lista-precio/index']); ?>">Listas de precios</a>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
                <ul class="navbar-nav mr-auto">

                    <?php if ($invitado) { ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= Url::toRoute(['login/index']); ?>">Iniciar sesion</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $usuario ?> (<?= $tipo ?>)
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="nav-link" href="<?= Url::toRoute(['login/cambiar-clave']); ?>">Cambiar clave</a></li>
                                <li> <a class="nav-link" href="<?= Url::toRoute(['login/logout']); ?>">Cerrar sesion</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>

    <main id="main" class="flex-shrink-0" role="main">
        <div class="container-fluid">
            <div class="marco pb-3">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </main>

    <?php $this->endBody() ?>
</body>

<div id="modalAdvertencia" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Advertencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row mt-3 justify-content-center">
                        <div class="col text-center" id="textoModalAdvertencia">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" id="btnAdvertencia" onclick="$('#modalAdvertencia').modal('hide');">Aceptar</button>
            </div>
        </div>
    </div>
</div>

</html>

<script>
    $("input[type='text']").click(function() {
        $(this).select();
    });
</script>

<?php $this->endPage() ?>