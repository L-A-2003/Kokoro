<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;
use yii\helpers\Json;

class ClienteProveedorController extends Controller
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
        $clientesProveedores = ClienteProveedorController::obtenerClientesProveedores();

        return $this->render('index', [
            'clientesProveedores' => $clientesProveedores
        ]);
    }

    public function actionCreate()
    {
        $tipo = $_POST['tipo'];
        $nombre = $_POST['nombre'];
        $documento = $_POST['documento'];

        if (isset($_POST['apellido'])) {
            $apellido = $_POST['apellido'];
        } else {
            $apellido = null;
        }

        if (isset($_POST['correo'])) {
            $correo = $_POST['correo'];
        } else {
            $correo = null;
        }

        if (isset($_POST['departamento'])) {
            $departamento = $_POST['departamento'];
        } else {
            $departamento = null;
        }

        if (isset($_POST['ciudad'])) {
            $ciudad = $_POST['ciudad'];
        } else {
            $ciudad = null;
        }

        if (isset($_POST['direccion'])) {
            $direccion = $_POST['direccion'];
        } else {
            $direccion = null;
        }

        if (isset($_POST['telefono'])) {
            $telefono = $_POST['telefono'];
        } else {
            $telefono = null;
        }

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('post')
            ->setUrl('http://localhost:3000/entidades.clienteProveedor/')
            ->setContent(Json::encode([
                'esProveedor' => $tipo,
                "nombre" => $nombre,
                "documento" => $documento,
                "apellido" => $apellido,
                "correo" => $correo,
                "departamento" => $departamento,
                "ciudad" => $ciudad,
                "direccion" => $direccion,
                "telefono" => $telefono
            ]))
            ->send();

        return $this->redirect(['index']);
    }

    public function actionUpdate()
    {
        $id = $_POST['id'];

        if (isset($_POST['nombre'])) {
            
            $tipo = $_POST['tipo'];
            $nombre = $_POST['nombre'];
            $documento = $_POST['documento'];
    
            if (isset($_POST['apellido'])) {
                $apellido = $_POST['apellido'];
            } else {
                $apellido = null;
            }
    
            if (isset($_POST['correo'])) {
                $correo = $_POST['correo'];
            } else {
                $correo = null;
            }
    
            if (isset($_POST['departamento'])) {
                $departamento = $_POST['departamento'];
            } else {
                $departamento = null;
            }
    
            if (isset($_POST['ciudad'])) {
                $ciudad = $_POST['ciudad'];
            } else {
                $ciudad = null;
            }
    
            if (isset($_POST['direccion'])) {
                $direccion = $_POST['direccion'];
            } else {
                $direccion = null;
            }

            if (isset($_POST['telefono'])) {
                $telefono = $_POST['telefono'];
            } else {
                $telefono = null;
            }

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('put')
                ->setUrl('http://localhost:3000/entidades.clienteProveedor?id=' . $id)
                ->setContent(Json::encode([
                    'esProveedor' => $tipo,
                    "nombre" => $nombre,
                    "documento" => $documento,
                    "apellido" => $apellido,
                    "correo" => $correo,
                    "departamento" => $departamento,
                    "ciudad" => $ciudad,
                    "direccion" => $direccion,
                    "telefono" => $telefono,
                    "id" => $id
                ]))
                ->send();
            
            return $this->redirect(['index']);
        } else {

            $clienteProveedor = $this->obtenerClienteProveedor($id);

            return $clienteProveedor;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('delete')
            ->setUrl('http://localhost:3000/entidades.clienteProveedor?id=' . $id)
            ->send();


        return $this->redirect(['index']);
    }

    public function obtenerClienteProveedor($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/entidades.clienteProveedor?id=' . $id)
            ->send();

        return $response->getContent();
    }

    static public function obtenerClientesProveedores()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/entidades.clienteProveedor/')
            ->send();

        return $response->getContent();
    }

    static public function obtenerClientes()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/clientesProveedores/?cliprov_tipo=C')
            ->send();

        return $response->getContent();
    }

    static public function obtenerProveedores()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/clientesProveedores/?cliprov_tipo=P')
            ->send();

        return $response->getContent();
    }
}
