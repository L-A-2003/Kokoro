<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;

class VendedorController extends Controller
{
    public function beforeAction($action)
    {
        if (!empty(Yii::$app->session->get('usuario'))) {
            return true;
        } else {
            return $this->redirect(['login/index']);
        }
    }

    public function actionIndex()
    {
        $vendedores = VendedorController::obtenerVendedores();

        return $this->render('index', [
            'vendedores' => $vendedores
        ]);
    }

    public function actionCreate()
    {
        $nick = $_POST['nick'];
        $nombre = $_POST['nombre'];
        $comision = $_POST['comision'];
        $clave = $_POST['clave'];

        //Llamada a la API para crear
        return 0;
    }

    public function actionUpdate()
    {
        $id = $_POST['id'];

        if (isset($_POST['nombre'])) {
            $nick = $_POST['nick'];
            $nombre = $_POST['nombre'];
            $comision = $_POST['comision'];

            //Llamada a la API para actualizar
            return $this->redirect(['index']);
        } else {

            $vendedor = $this->obtenerVendedor($id);

            return $vendedor;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        //Llamada a la API para borrar
        return $this->redirect(['index']);
    }

    public function obtenerVendedor($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/vendedores/' . $id)
            ->send();

        return $response->getContent();
    }

    public function obtenerVendedores()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/vendedores/')
            ->send();

        return $response->getContent();
    }
}
