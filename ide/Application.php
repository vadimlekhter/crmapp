<?php
namespace yii\web;
use app\services\EmailService;
use app\services\NotificationService;
use app\services\ServiceService;
use \yii\queue\amqp_interop\Queue;
use yii\redis\Connection;

/**
 * @property EmailService $emailService
 * @property NotificationService $notificationService
 * @property ServiceService $serviceService
 * @property Queue $queue
 * @property Connection $redis
 */
class Application
{
}
