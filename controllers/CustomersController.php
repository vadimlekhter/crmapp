<?php


namespace app\controllers;

use app\models\customer\CustomerRecord;
use app\models\customer\PhoneRecord;
use app\traits\CustomersTrait;
use yii\helpers\Url;
use yii\web\Controller;
use Yii;
use yii\web\MethodNotAllowedHttpException;

class CustomersController extends Controller
{
    use CustomersTrait;

    public function actionIndex()
    {
        if (Yii::$app->user->can('allCustomers')) {
            $records = $this->commonIndex();
            return $this->render('index', compact('records'));
        } else throw new MethodNotAllowedHttpException('Вам запрещен доступ');
    }

    public function actionView($id)
    {
        if (Yii::$app->user->can('viewCustomer')) {
            $customer = $this->commonView($id);
            return $this->render('view', [
                'model' => $customer,
            ]);
        } else throw new MethodNotAllowedHttpException('Вам запрещен доступ');
    }

    public function actionCreate()
    {
        if (Yii::$app->user->can('createCustomer')) {
            $record = $this->commonCreate();
            extract($record);
            return $this->render('create', compact('customer_record', 'phone_record'));
        } else throw new MethodNotAllowedHttpException('Вам запрещен доступ');
    }

    public function actionUpdate($id)
    {
        if (Yii::$app->user->can('updateCustomer')) {
            $record = $this->commonUpdate($id);
            extract($record);
            return $this->render('update', compact('customer_record', 'phone_record'));
        } else throw new MethodNotAllowedHttpException('Вам запрещен доступ');
    }

    public function actionDelete($id)
    {
        if (Yii::$app->user->can('deleteCustomer')) {
            $this->commonDelete($id);
            $this->redirect(Url::to(['index']));
        }
    }

    public function actionFinded()
    {
        $records = $this->findRecordsByQuery();
        return $this->render('finded', compact('records'));
    }


    public function actionQuery()
    {
        return $this->render('query');
    }

    private function findRecordsByQuery()
    {
        $number = Yii::$app->request->get('phone_number');
        $records = $this->getRecordsByPhoneNumber($number);

        return $this->wrapIntoDataProvider($records);
    }

    private function getRecordsByPhoneNumber($number)
    {
        $result = [];
        $records = PhoneRecord::findAll(['number' => $number]);
        if (!$records) return [];

        foreach ($records as $record) {
            $customer_record = CustomerRecord::findOne($record->customer_id);
            if (!$customer_record) return [];
            array_push($result, $this->makeCustomer($customer_record, $record));
        }
        return $result;
    }
}