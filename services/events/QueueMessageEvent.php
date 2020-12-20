<?php


namespace app\services\events;


class QueueMessageEvent extends \yii\base\Event
{
    public $message;
}