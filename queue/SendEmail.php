<?php


namespace app\queue;


use app\services\EmailService;
use yii\queue\Queue;

class SendEmail extends \yii\base\BaseObject implements \yii\queue\JobInterface
{

    public $to;
    public $subject;
    public $data;
    public $views;

    public function execute($queue)
    {
        echo 'Mail Sended';
        \Yii::$app->emailService->send($this->to, $this->subject, $this->data, $this->views);
    }
}