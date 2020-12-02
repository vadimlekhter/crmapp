<?php


namespace app\services\events;


class AddServiceEvent extends \yii\base\Event
{
    public $service;
    public $hourly_rate;
}