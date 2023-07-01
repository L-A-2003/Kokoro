<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class SiteController extends Controller
{

    public function beforeAction($action)
    {
        if (!empty(Yii::$app->session->get('usuario'))) {
            return true;
        } else {
            return $this->redirect(['login/index']);
        }
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $clientes = ClienteProveedorController::obtenerClientes();
        $proveedores = ClienteProveedorController::obtenerProveedores();
        $productos = ProductoController::obtenerProductos();

        return $this->render('index', [
            'clientes' => json_decode($clientes),
            'proveedores' => json_decode($proveedores),
            'productos' => json_decode($productos)
        ]);
    }
}
