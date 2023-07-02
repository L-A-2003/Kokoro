<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use yii\helpers\Json;

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

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl('http://localhost:3000/entidades.usuario/')
            ->setContent(Json::encode([
                "nickname" => $nick,
                "nombre" => $nombre,
                "clave" => $clave,
            ]))
            ->send();

        $client2 = new Client();
        $response2 = $client2->createRequest()
            ->setMethod('post')
            ->setUrl('http://localhost:3000/entidades.vendedor/')
            ->setContent(Json::encode([
                "comision" => $comision
            ]))
            ->send();
        
        return 0;
    }

    public function actionUpdate()
    {
        $id = $_POST['id'];

        if (isset($_POST['nombre'])) {
            $nick = $_POST['nick'];
            $nombre = $_POST['nombre'];
            $comision = $_POST['comision'];

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('put')
                ->setUrl('http://localhost:3000/entidades.usuario?id=' . $id)
                ->setContent(Json::encode([
                    "nickname" => $nick,
                    "nombre" => $nombre
                ]))
                ->send();

            $client2 = new Client();
            $response2 = $client2->createRequest()
                ->setMethod('put')
                ->setUrl('http://localhost:3000/entidades.vendedor?id=' . $id)
                ->setContent(Json::encode([
                    "comision" => $comision
                ]))
                ->send();
            
            return $this->redirect(['index']);
        } else {

            $vendedor = $this->obtenerVendedor($id);

            return $vendedor;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('delete')
            ->setUrl('http://localhost:3000/entidades.usuario?id=' . $id)
            ->send();

        $client2 = new Client();
        $response2 = $client2->createRequest()
            ->setMethod('delete')
            ->setUrl('http://localhost:3000/entidades.vendedor?id=' . $id)
            ->send();
        
        return $this->redirect(['index']);
    }

    public function obtenerVendedor($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/entidades.vendedor?id=' . $id)
            ->send();

        return $response->getContent();
    }

    public function obtenerVendedores()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/entidades.vendedor/')
            ->send();

        return $response->getContent();
    }
}
