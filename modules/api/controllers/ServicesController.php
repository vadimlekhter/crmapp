<?php


namespace app\modules\api\controllers;


use app\models\service\ServiceRecord;
use \yii\rest\ActiveController;

class ServicesController extends ActiveController
{
    public $modelClass = ServiceRecord::class;
}