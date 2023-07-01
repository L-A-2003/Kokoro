<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;

class TalleController extends Controller
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
        $talles = TalleController::obtenerTalles();

        return $this->render('index', [
            'talles' => $talles
        ]);
    }

    public function actionCreate()
    {
        $nombre = $_POST['nombre'];

        //Llamada a la API para crear
        return $this->redirect(['index']);
    }

    public function actionUpdate()
    {
        $id = $_POST['id'];

        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];

            //Llamada a la API para actualizar
            return $this->redirect(['index']);
        } else {

            $talle = $this->obtenerTalle($id);

            return $talle;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        //Llamada a la API para borrar
        return $this->redirect(['index']);
    }

    public function obtenerTalle($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/talles/' . $id)
            ->send();

        return $response->getContent();
    }

    static public function obtenerTalles()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/talles/')
            ->send();

        return $response->getContent();
    }
}
