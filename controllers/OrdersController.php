<?php


namespace app\controllers;


class OrdersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $items = \Yii::$app->redis->get('Vadim');
        return $this->render('index', ['items' => $items]);
    }
}