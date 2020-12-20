<?php


namespace app\services;

use app\services\events\QueueMessageEvent;
use \yii\base\Component;

class QueueService extends Component
{
    const EVENT_QUEUE_MESSAGE =  'event_queue_message';

    public function emailQueueMessage(string $message)
    {
        $event = $this->eventQueueMessage($message);
        $notificationService = new NotificationService();
        $this->on(self::EVENT_QUEUE_MESSAGE, [$notificationService, 'sendQueueMessageEmail'], $event);
        $this->trigger(self::EVENT_QUEUE_MESSAGE, $event);
    }

    private function eventQueueMessage(string $message)
    {
        $event = new QueueMessageEvent();
        $event->message = $message;
        return $event;
    }
}