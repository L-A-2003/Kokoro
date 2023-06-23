<?php

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;

class CategoriaController extends Controller
{
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

            $categoria = $this->obtenerCategoria($id);

            return $categoria;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        //Llamada a la API para borrar
        return $this->redirect(['index']);
    }

    public function obtenerCategoria($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/categorias/' . $id)
            ->send();

        return $response->getContent();
    }

    static public function obtenerCategorias()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/categorias/')
            ->send();

        return $response->getContent();
    }
}
