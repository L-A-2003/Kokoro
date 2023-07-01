<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

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

        if (true) { //Si los datos son correctos

            $session = Yii::$app->session;
            $session->open();
            $session->set('usuario', $usuario);
            $session->set('tipo', 'Administrador');//Esto viene por API

            return 2;
        } else {
            return 0;
        }
    }

    public function actionLogout()
    {
            $session = Yii::$app->session;
            $session->close();

         $this->redirect(['index']);
    }

    public function actionCambiarClave()
    {
        if (isset($_POST['clave'])) {

            $clave = $_POST['clave'];

            //Llamada a la api para cambiar la clave

            return 0; //return de la api
        } else {
            return $this->render('cambiarClave');
        }
    }
}
