<?php


namespace app\modules\api\controllers;

use app\models\customer\Customer;
use app\modules\api\models\CustomerRecord;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\ContentNegotiator;
use yii\helpers\Url;
use yii\rest\Controller;
use yii\web\Response;
use yii\web\ServerErrorHttpException;


class CustomerController extends Controller
{
    public function behaviors()
    {
//        $behaviours = parent::behaviors();
        $behaviors['authenticator'] = [
//            'class' => HttpBasicAuth::class,
//            'class' => QueryParamAuth::class,
            'class' => HttpBearerAuth::class
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        return $behaviors;
    }

    public function actionIndex()
    {
        return new ActiveDataProvider(
            ['query' => CustomerRecord::find()]
        );
    }

    public function actionView($id)
    {
        return CustomerRecord::findOne($id);
    }

    public function actionCreate()
    {
        $model = new CustomerRecord();

        $model->load(\Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save()) {
            $response = \Yii::$app->getResponse();
            $response->setStatusCode(201);
            $id = implode(',', array_values($model->getPrimaryKey(true)));
            $response->getHeaders()->set('Location', Url::toRoute(['customer/view', 'id' => $id], true));
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }

        return $model;
    }

    public function actionUpdate($id)
    {
        $model = CustomerRecord::findOne($id);

        $model->load(\Yii::$app->getRequest()->getBodyParams(), '');
        if ($model->save() === false && !$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }

        return $model;
    }

    public function actionDelete($id)
    {
        $deleted_record = CustomerRecord::findOne($id);
        $deleted_record->delete();
    }
}