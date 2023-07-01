<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;

class ListaPrecioController extends Controller
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
        $listasPrecios = ListaPrecioController::obtenerListasPrecios();
        $temporadas = TemporadaController::obtenerTemporadas();
        $categorias = CategoriaController::obtenerCategorias();

        return $this->render('index', [
            'listasPrecios' => $listasPrecios,
            'temporadas' => json_decode($temporadas),
            'categorias' => json_decode($categorias)
        ]);
    }

    public function actionCreate()
    {
        $nombre = $_POST['nombre'];
        $porcentajeModificacion = $_POST['porcentaje'];
        $temporada = $_POST['temporada'];

        if (isset($_POST['categoria'])) {
            $categoria = $_POST['categoria'];
        } else {
            $categoria = null;
        }

        if (isset($_POST['desde'])) {
            $desde = $_POST['desde'];
        } else {
            $desde = null;
        }

        if (isset($_POST['hasta'])) {
            $hasta = $_POST['hasta'];
        } else {
            $hasta = null;
        }

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

            if (isset($_POST['categoria'])) {
                $categoria = $_POST['categoria'];
            } else {
                $categoria = null;
            }

            if (isset($_POST['desde'])) {
                $desde = $_POST['desde'];
            } else {
                $desde = null;
            }

            if (isset($_POST['hasta'])) {
                $hasta = $_POST['hasta'];
            } else {
                $hasta = null;
            }

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
