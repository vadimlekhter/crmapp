<?php


namespace app\console\controllers;


use app\queue\DownloadJob;
use app\queue\SendEmail;
use app\services\QueueService;
use yii\console\Controller;

class AppQueueController extends Controller
{
    public function actionLoad()
    {
        \Yii::$app->queue->push(new DownloadJob([
            'url' => 'https://www.vladtime.ru/uploads/posts/2017-07/1499058067_5143.jpg',
            'file' => '/crmapp/image.jpg',
        ]));
    }

    public function actionSendEmail()
    {
        \Yii::$app->queue->delay(300)->push(new SendEmail([
            'to' => 'v_lehter@mail.ru',
            'subject' => 'MQ',
            'data' => ['message' => 'Rabbit'],
            'views' => ['html' => 'mq-html', 'text' => 'mq-text']
        ]));
    }
    public function actionOrder()
    {
        $queueService = new QueueService();
        $queueService->emailQueueMessage('hi');
    }
}