<?php


namespace app\modules\api\controllers;

use app\models\customer\Customer;
use app\models\customer\CustomerRecord;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\rest\Controller;
use yii\web\ServerErrorHttpException;


class CustomerController extends Controller
{
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