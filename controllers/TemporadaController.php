<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use yii\helpers\Json;

class TemporadaController extends Controller
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
        $temporadas = TemporadaController::obtenerTemporadas();

        return $this->render('index', [
            'temporadas' => $temporadas
        ]);
    }

    public function actionCreate()
    {
        $nombre = $_POST['nombre'];

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl('http://localhost:3000/entidades.temporada/')
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
                ->setUrl('http://localhost:3000/entidades.temporada?id=' . $id)
                ->setContent(Json::encode([
                    "nombre" => $nombre,
                    "id" => $id,
                ]))
                ->send();

            return $this->redirect(['index']);
        } else {

            $temporada = $this->obtenerTemporada($id);

            return $temporada;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('delete')
            ->setUrl('http://localhost:3000/entidades.temporada?id=' . $id)
            ->send();

        return $this->redirect(['index']);
    }

    public function obtenerTemporada($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/entidades.temporada?id=' . $id)
            ->send();

        return $response->getContent();
    }

    static public function obtenerTemporadas()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/entidades.temporada/')
            ->send();

        return $response->getContent();
    }
}
