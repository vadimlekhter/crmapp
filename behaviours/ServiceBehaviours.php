<?php


namespace app\behaviours;

use app\services\NotificationService;
use \yii\base\Behavior;
use app\services\ServiceService;

class ServiceBehaviours extends Behavior
{
    public $owner = ServiceService::class;

    public function events()
    {
        $notificationService = new NotificationService();
        return [
            ServiceService::EVENT_NEW_SERVICE => [$notificationService, 'sendAddServiceEmail'],
            ServiceService::EVENT_DELETE_SERVICE => [$notificationService, 'sendDeleteServiceEmail']
        ];
    }
}