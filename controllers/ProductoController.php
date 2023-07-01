<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;

class ProductoController extends Controller
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
        $productos = ProductoController::obtenerProductos();
        $listasPrecios = ListaPrecioController::obtenerListasPrecios();
        $categorias = CategoriaController::obtenerCategorias();
        $temporadas = TemporadaController::obtenerTemporadas();
        $talles = TalleController::obtenerTalles();

        return $this->render('index', [
            'productos' => $productos,
            'listasPrecios' => json_decode($listasPrecios),
            'categorias' => json_decode($categorias),
            'temporadas' => json_decode($temporadas),
            'talles' => $talles
        ]);
    }

    public function actionCreate()
    {
        $nombre = $_POST['nombre'];
        $genero = $_POST['genero'];
        $categoria = $_POST['categoria'];
        $temporada = $_POST['temporada'];
        $etiquetas = $_POST['etiquetas'];
        $listaPrecio = $_POST['listaPrecio'];
        $talles = $_POST['talles'];

        //Llamada a la API para crear
        return 0;
    }

    public function actionUpdate()
    {
        $id = $_POST['id'];

        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $genero = $_POST['genero'];
            $categoria = $_POST['categoria'];
            $temporada = $_POST['temporada'];
            $etiquetas = $_POST['etiquetas'];
            $listaPrecio = $_POST['listaPrecio'];

            //Llamada a la API para actualizar
            return $this->redirect(['index']);
        } else {

            $producto = $this->obtenerProducto($id);

            return $producto;
        }
    }

    public function actionUpdateTalles()
    {
        $id = $_POST['id'];

        if (isset($_POST['talles'])) {
            $talles = $_POST['talles'];

            //Llamada a la API para actualizar
            return 0;
        } else {

            $talles = $this->obtenerTallesProducto($id);

            return $talles;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        //Llamada a la API para borrar
        return $this->redirect(['index']);
    }

    public function actionObtenerTallesProducto(){
        $id = $_POST['id'];

        return ProductoController::obtenerTallesProducto($id);
    }

    public function obtenerProducto($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/productos/' . $id)
            ->send();

        return $response->getContent();
    }

    static public function obtenerTallesProducto($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/talles_producto?tal_prod_prod_id=' . $id)
            ->send();

        return $response->getContent();
    }

    static public function obtenerProductos()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/productos/')
            ->send();

        return $response->getContent();
    }
}
