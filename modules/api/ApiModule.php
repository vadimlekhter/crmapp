<?php


namespace app\modules\api;

use yii\base\Module;

class ApiModule extends Module
{
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
    }
}