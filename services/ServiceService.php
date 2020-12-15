<?php


namespace app\services;

use app\behaviours\ServiceBehaviours;
use app\models\service\ServiceRecord;
use app\services\events\NewServiceEvent;
use app\services\events\DeleteServiceEvent;
use yii\base\Component;

/**
 * Class ServiceService
 * @package app\services
 */
class ServiceService extends Component
{
    const EVENT_NEW_SERVICE = 'event_new_service';
    const EVENT_DELETE_SERVICE = 'delete_service';

    public function behaviors()
    {
        return [
            'class' => ServiceBehaviours::class
        ];
    }

    public function emailNewService(ServiceRecord $model)
    {
        $event = $this->eventNewService($model);
//        $notificationService = new NotificationService();
//        $this->on(ServiceService::EVENT_NEW_SERVICE, [$notificationService, 'sendAddServiceEmail'], $event);
        $this->trigger(self::EVENT_NEW_SERVICE, $event);
    }

    public function emailDeleteService(string $service_name)
    {
        $event = $this->eventDeleteService($service_name);
//        $notificationService = new NotificationService();
//        $this->on(ServiceService::EVENT_DELETE_SERVICE, [$notificationService, 'sendDeleteServiceEmail'], $event);
        $this->trigger(self::EVENT_DELETE_SERVICE, $event);
    }

    private function eventNewService(ServiceRecord $model)
    {
        $event = new NewServiceEvent();
        $event->service = $model->name;
        $event->hourly_rate = $model->hourly_rate;
        return $event;
    }

    private function eventDeleteService(string $service_name)
    {
        $event = new DeleteServiceEvent();
        $event->service = $service_name;
        return $event;
    }
}
