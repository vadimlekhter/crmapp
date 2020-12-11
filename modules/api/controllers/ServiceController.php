<?php


namespace app\modules\api\controllers;


use app\modules\api\models\Service;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use \yii\rest\ActiveController;

class ServiceController extends ActiveController
{
    public $modelClass = Service::class;

//    public function behaviors()
//    {
//        $behaviours = parent::behaviors();
//        $behaviors['authenticator'] = [
////            'class' => HttpBasicAuth::class,
//            'class' => HttpBearerAuth::class
//        ];
//        return $behaviors;
//    }
}