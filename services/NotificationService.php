<?php


namespace app\services;

use app\services\events\NewServiceEvent;
use app\services\events\DeleteServiceEvent;
use app\services\events\QueueMessageEvent;
use \yii\base\Component;

class NotificationService extends Component
{
    public function sendNewServiceEmail(NewServiceEvent $e)
    {
        $to = \Yii::$app->params['adminEmail'];
        $subject = 'New service';
        $data = ['service' => $e->service, 'hourly_rate' => $e->hourly_rate];
        $views = ['html' => 'add-service-html', 'text' => 'add-service-text'];
        \Yii::$app->emailService->send($to, $subject, $data, $views);
    }

    public function sendDeleteServiceEmail(DeleteServiceEvent $e)
    {
        $to = \Yii::$app->params['adminEmail'];
        $subject = 'Deleted service';
        $data = ['service' => $e->service];
        $views = ['html' => 'delete-service-html', 'text' => 'delete-service-text'];
        \Yii::$app->emailService->send($to, $subject, $data, $views);
    }

    public function sendQueueMessageEmail(QueueMessageEvent $e)
    {
        $to = \Yii::$app->params['adminEmail'];
        $subject = 'Queue Message';
        $data = ['item' => $e->item, 'customer' => $e->customer];
        $views = ['html' => 'queue-html', 'text' => 'queue-text'];
        \Yii::$app->emailService->send($to, $subject, $data, $views);
    }
}