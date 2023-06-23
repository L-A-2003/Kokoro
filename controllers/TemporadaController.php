<?php

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;

class TemporadaController extends Controller
{
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

            $temporada = $this->obtenerTemporada($id);

            return $temporada;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        //Llamada a la API para borrar
        return $this->redirect(['index']);
    }

    public function obtenerTemporada($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/temporadas/' . $id)
            ->send();

        return $response->getContent();
    }

    static public function obtenerTemporadas()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/temporadas/')
            ->send();

        return $response->getContent();
    }
}
