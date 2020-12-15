<?php


namespace app\services\events;


class NewServiceEvent extends \yii\base\Event
{
    public $service;
    public $hourly_rate;
}