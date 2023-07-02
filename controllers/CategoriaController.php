<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use yii\helpers\Json;

class CategoriaController extends Controller
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
        $categorias = CategoriaController::obtenerCategorias();

        return $this->render('index', [
            'categorias' => $categorias
        ]);
    }

    public function actionCreate()
    {
        $nombre = $_POST['nombre'];

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl('http://localhost:3000/entidades.categoria/')
            ->setContent(Json::encode([
                "nombre" => $nombre
            ]))
            ->send();

        return $this->redirect(['index']);
    }

    public function actionUpdate()
    {
        $id = $_POST['id'];

        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('put')
                ->setUrl('http://localhost:3000/entidades.categoria?id=' . $id)
                ->setContent(Json::encode([
                    "nombre" => $nombre,
                    "id" => $id,
                ]))
                ->send();

            return $this->redirect(['index']);
        } else {

            $categoria = $this->obtenerCategoria($id);
            return $categoria;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('delete')
            ->setUrl('http://localhost:3000/entidades.categoria?id=' . $id)
            ->send();

        return $this->redirect(['index']);
    }

    public function obtenerCategoria($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/entidades.categoria?id=' . $id)
            ->send();

        return $response->getContent();
    }

    static public function obtenerCategorias()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/entidades.categoria/')
            ->send();

        return $response->getContent();
    }
}
