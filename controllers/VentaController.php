<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use yii\helpers\Url;

class VentaController extends Controller
{
    public function beforeAction($action)
    {
        if (!empty(Yii::$app->session->get('usuario'))) {
            return true;
        } else {
            return $this->redirect(['login/index']);
        }
    }

    public function actionCreate()
    {
        $tipoDocumento = $_POST['tipoDocumento'];
        $adenda = $_POST['adenda'];
        $cliente = $_POST['cliente'];
        $proveedor = $_POST['proveedor'];
        $formaPago = $_POST['formaPago'];
        $datos = $_POST['datos'];

        foreach ($datos as $dato) {
            $dato['producto'];
        }

        //Llamada a la API para crear
        return 0;
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        //Llamada a la API para borrar
        return $this->redirect(['index']);
    }

    public function obtenerVenta($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/ventas/' . $id)
            ->send();

        return $response->getContent();
    }

    static public function obtenerVentas()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/ventas/')
            ->send();

        return $response->getContent();
    }
}
