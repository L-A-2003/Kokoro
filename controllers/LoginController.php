<?php

namespace app\controllers;

use yii\web\Controller;
use yii\httpclient\Client;

class LoginController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {

        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        //Llamada a la api para logearse

        return "KFvs3zAyOSGXc3i5L3gtP3F7DMLbPmSEJ6U6OFAZaOxI2qIo0399iSjIA4LF0qvA"; //return de la api
    }

    public function actionCambiarClave()
    {
        if (isset($_POST['clave'])) {

            $clave = $_POST['clave'];

            //Llamada a la api para cambiar la clave

            return 0; //return de la api
        } else{
            return $this->render('cambiarClave');
        }
    }
}
