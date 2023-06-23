<?php

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;

class ClienteProveedorController extends Controller
{
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

        //Llamada a la API para crear
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

            //Llamada a la API para actualizar
            return $this->redirect(['index']);
        } else {

            $clienteProveedor = $this->obtenerClienteProveedor($id);

            return $clienteProveedor;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        //Llamada a la API para borrar
        return $this->redirect(['index']);
    }

    public function obtenerClienteProveedor($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/clientesProveedores/' . $id)
            ->send();

        return $response->getContent();
    }

    static public function obtenerClientesProveedores()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/clientesProveedores/')
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
