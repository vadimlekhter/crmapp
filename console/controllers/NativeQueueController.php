<?php


namespace app\console\controllers;

use \yii\console\Controller;
use app\modules\queue\amqp\SimpleReceiver;

class NativeQueueController extends Controller
{
    public function actionReceiver()
    {
        $receiver = new SimpleReceiver();
        $receiver->listen();
    }
}