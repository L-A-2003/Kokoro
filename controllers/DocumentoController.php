<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\httpclient\Client;

class DocumentoController extends Controller
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
        //$documentos = DocumentoController::obtenerDocumentos();

        return $this->render('index', [
            //'documentos' => $documentos
        ]);
    }

    public function obtenerDocumento($id)
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/documentos/' . $id)
            ->send();

        return $response->getContent();
    }

    static public function obtenerDocumentos()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:3000/documentos/')
            ->send();

        return $response->getContent();
    }
}
