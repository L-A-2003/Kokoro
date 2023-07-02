<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use yii\helpers\Json;

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
        $etiqueta = $_POST['etiquetas'];
        //$listaPrecio = $_POST['listaPrecio'];
        $talles = $_POST['talles'];

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('put')
            ->setUrl('http://localhost:3000/entidades.producto/')
            ->setContent(Json::encode([
                "nombre" => $nombre,
                "genero" => $genero,
                "categoria" => $categoria,
                "temporada" => $temporada,
                "etiqueta" => $etiqueta,
            ]))
            ->send();

        $idProducto = $response->getContent();
        $array = array();

        foreach ($talles as $talle) {
            $index = null;
            $index2['producto'] = $idProducto;
            $index3['talle'] = $talle['id'];

            $index['producto'] = $index2;
            $index['talle'] = $index3;
            $index['precioCosto'] = $talle['costo'];
            $index['precioVenta'] = $talle['venta'];
            $index['margenGanancia'] = $talle['ganancia'];
            $index['stock'] = $talle['stock'];

            array_push($array, $index);
        }

        $client2 = new Client();
        $response2 = $client2->createRequest()
            ->setMethod('put')
            ->setUrl('http://localhost:3000/entidades.producto/')
            ->setContent(Json::encode([
                "array" => $array,
            ]))
            ->send();

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
            $etiqueta = $_POST['etiquetas'];
            //$listaPrecio = $_POST['listaPrecio'];

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('put')
                ->setUrl('http://localhost:3000/entidades.producto?id=' . $id)
                ->setContent(Json::encode([
                    "nombre" => $nombre,
                    "genero" => $genero,
                    "categoria" => $categoria,
                    "temporada" => $temporada,
                    "etiqueta" => $etiqueta,
                    "id" => $id,
                ]))
                ->send();

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

            $array = array();

            foreach ($talles as $talle) {
                $index = null;
                $index2['producto'] = $id;
                $index3['talle'] = $talle['id'];

                $index['producto'] = $index2;
                $index['talle'] = $index3;
                $index['precioCosto'] = $talle['costo'];
                $index['precioVenta'] = $talle['venta'];
                $index['margenGanancia'] = $talle['ganancia'];
                $index['stock'] = $talle['stock'];

                array_push($array, $index);
            }

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('put')
                ->setUrl('http://localhost:3000/entidades.producto/')
                ->setContent(Json::encode([
                    "array" => $array,
                ]))
                ->send();

            return 0;
        } else {

            $talles = $this->obtenerTallesProducto($id);

            return $talles;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('delete')
            ->setUrl('http://localhost:3000/entidades.producto?id=' . $id)
            ->send();

        return $this->redirect(['index']);
    }

    public function actionObtenerTallesProducto()
    {
        $id = $_POST['id'];

        return ProductoController::obtenerTallesProducto($id);
    }

    public function obtenerProducto($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/entidades.producto?id=' . $id)
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
            ->setUrl('http://localhost:3000/entidades.producto/')
            ->send();

        return $response->getContent();
    }
}
