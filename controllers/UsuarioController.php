<?php

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;

class UsuarioController extends Controller
{
    public function actionIndex()
    {
        $usuarios = UsuarioController::obtenerUsuarios();

        return $this->render('index', [
            'usuarios' => $usuarios
        ]);
    }

    public function actionCreate()
    {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $tipo = $_POST['tipo'];
        // Faltan los roles

        //Llamada a la API para crear
        return $this->redirect(['index']);
    }

    public function actionUpdate()
    {
        $id = $_POST['id'];

        if (isset($_POST['usuario'])) {
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $tipo = $_POST['tipo'];
            // Faltan los roles

            //Llamada a la API para actualizar
            return $this->redirect(['index']);
        } else {

            $usuario = $this->obtenerUsuario($id);

            return $usuario;
        }
    }

    public function actionDelete()
    {
        $id = $_POST['id'];

        //Llamada a la API para borrar
        return $this->redirect(['index']);
    }

    public function obtenerUsuario($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/usuarios/' . $id)
            ->send();

        return $response->getContent();
    }

    public function obtenerUsuarios()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/usuarios/')
            ->send();

        return $response->getContent();
    }
}
