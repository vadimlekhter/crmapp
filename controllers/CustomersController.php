<?php


namespace app\controllers;

use app\models\customer\Customer;
use app\models\customer\CustomerRecord;
use app\models\customer\Phone;
use app\models\customer\PhoneRecord;
use Codeception\Exception\ContentNotFound;
use yii\base\ErrorException;
use yii\data\ArrayDataProvider;
use yii\db\Exception;
use yii\web\Controller;
use Yii;
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;

class CustomersController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->can('allCustomers')) {

            $records = [];
            $customer_records = CustomerRecord::find()->all();

            foreach ($customer_records as $customer_record) {
                $phone_record = PhoneRecord::find()->where(['customer_id' => $customer_record->id])->one();
                $customer = $this->makeCustomer($customer_record, $phone_record);
                array_push($records, $customer);
            }

            $records = $this->wrapIntoDataProvider($records);
            return $this->render('index', compact('records'));

        } else throw new MethodNotAllowedHttpException('Вам запрещен доступ');
    }

    public function actionView($name)
    {
        if (Yii::$app->user->can('viewCustomer')) {
            $customer_record = CustomerRecord::find()->where(['name' => $name])->one();
            $phone_record = PhoneRecord::find()->where(['customer_id' => $customer_record->id])->one();
            $customer = $this->makeCustomer($customer_record, $phone_record);
            return $this->render('view', [
                'model' => $customer,
            ]);
        } else throw new MethodNotAllowedHttpException('Вам запрещен доступ');
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
        if (!empty($records)) {
            $data = [];
            array_push($data, $records);
        } else return $this->wrapIntoDataProvider($records);
        return $this->wrapIntoDataProvider($data);
    }

    private function getRecordsByPhoneNumber($number)
    {
        $phone_record = PhoneRecord::findOne(['number' => $number]);
        if (!$phone_record) return [];

        $customer_record = CustomerRecord::findOne($phone_record->customer_id);
        if (!$customer_record) return [];

        return $this->makeCustomer($customer_record, $phone_record);
    }

    private function wrapIntoDataProvider($data)
    {
        $provider = new ArrayDataProvider(
            [
                'allModels' => $data,
//                'pagination' => [
//                    'pageSize' => 5,
//                ],
            ]
        );

        return $provider;
    }

    public function actionAdd()
    {
        if (Yii::$app->user->can('addCustomer')) {
            $customer = new CustomerRecord;
            $phone = new PhoneRecord;

            if ($this->load($customer, $phone, \Yii::$app->request->post())) {
                $this->store($this->makeCustomer($customer, $phone));
                $this->redirect('/customers/index');
            }
            return $this->render('add', compact('customer', 'phone'));
        } else throw new MethodNotAllowedHttpException('Вам запрещен доступ');
    }

    private function load(CustomerRecord $customer, PhoneRecord $phone, array $post)
    {
        return
            $customer->load($post) &
            $customer->validate($post) &
            $phone->load($post) &
            $phone->validate(['number', 'home_number', 'work_number']);
    }

    private function store(Customer $customer)
    {
        $customer_record = new CustomerRecord();
        $customer_record->name = $customer->name;
        $customer_record->birth_date = $customer->birth_date->format('Y-m-d H:i:s');
        $customer_record->notes = $customer->notes;
        $customer_record->save(false);

        $phone_record = new PhoneRecord();
        $phone_record->customer_id = $customer_record->id;
        $phone_record->number = $customer->phones->number;
        $phone_record->home_number = $customer->phones->home_number;
        $phone_record->work_number = $customer->phones->work_number;
        $phone_record->save();
    }

    private function makeCustomer(CustomerRecord $customer_record, PhoneRecord $phone_record)
    {
        $customer = new Customer($customer_record->name, new \DateTime($customer_record->birth_date));
        $customer->notes = $customer_record->notes;
        $customer->phones = new Phone($phone_record->number, $phone_record->home_number, $phone_record->work_number);
        return $customer;
    }
}