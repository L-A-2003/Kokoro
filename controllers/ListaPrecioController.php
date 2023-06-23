<?php

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;

class ListaPrecioController extends Controller
{
    public function actionIndex()
    {
        $listasPrecios = ListaPrecioController::obtenerListasPrecios();
        $temporadas = TemporadaController::obtenerTemporadas();

        return $this->render('index', [
            'listasPrecios' => $listasPrecios,
            'temporadas' => json_decode($temporadas),
        ]);
    }

    public function actionCreate()
    {
        $nombre = $_POST['nombre'];
        $porcentajeModificacion = $_POST['porcentaje'];
        $temporada = $_POST['temporada'];

        //Llamada a la API para crear
        return $this->redirect(['index']);
    }

    public function actionUpdate()
    {
        $id = $_POST['id'];

        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $porcentajeModificacion = $_POST['porcentaje'];
            $temporada = $_POST['temporada'];

            //Llamada a la API para actualizar
            return $this->redirect(['index']);
        } else {

            $listaPrecio = $this->obtenerListaPrecio($id);

            return $listaPrecio;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        //Llamada a la API para borrar
        return $this->redirect(['index']);
    }

    public function obtenerListaPrecio($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/listasPrecios/' . $id)
            ->send();

        return $response->getContent();
    }

    static public function obtenerListasPrecios()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/listasPrecios/')
            ->send();

        return $response->getContent();
    }
}
