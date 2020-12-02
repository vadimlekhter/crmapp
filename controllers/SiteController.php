<?php


namespace app\controllers;

use yii\web\Controller;
use app\models\user\LoginForm;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $model = new LoginForm;
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {

            \Yii::info(\Yii::$app->user->identity->username, 'login');

            $this->goBack();
        }
        return $this->render('login', compact('model'));
    }

    public function actionLogout()
    {

        \Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionDocs()
    {
        return $this->render('docindex.md');
    }
}