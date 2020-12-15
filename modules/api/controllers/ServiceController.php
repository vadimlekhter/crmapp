<?php


namespace app\modules\api\controllers;


use app\modules\api\models\Service;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use \yii\rest\ActiveController;
use yii\web\Response;

class ServiceController extends ActiveController
{
    public $modelClass = Service::class;

    public function behaviors()
    {
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }
}