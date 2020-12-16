<?php


namespace app\traits;


use app\models\customer\Customer;
use app\models\customer\CustomerRecord;
use app\models\customer\Phone;
use app\models\customer\PhoneRecord;
use yii\data\ArrayDataProvider;

trait CustomersTrait
{
    private function makeCustomer(CustomerRecord $customer_record, PhoneRecord $phone_record = null)
    {
        $customer = new Customer($customer_record->name, new \DateTime($customer_record->birth_date));
        $customer->id = $customer_record->id;
        $customer->notes = $customer_record->notes;

        if (!is_null($phone_record)) {
            $customer->phones = new Phone($phone_record->number, $phone_record->home_number, $phone_record->work_number);
        } else {
            $customer->phones = null;
        }
        return $customer;
    }

    private function load(CustomerRecord $customer_record, PhoneRecord $phone_record, array $post)
    {
        return
            $customer_record->load($post) &
            $customer_record->validate($post) &
            $phone_record->load($post) &
            $phone_record->validate(['number', 'home_number', 'work_number']);
    }

//    private function store(Customer $customer)
//    {
//        $customer_record = new CustomerRecord();
//        $customer_record->name = $customer->name;
//        $customer_record->birth_date = $customer->birth_date->format('Y-m-d H:i:s');
//        $customer_record->notes = $customer->notes;
//        $customer_record->save(false);
//
//        $phone_record = new PhoneRecord();
//        $phone_record->customer_id = $customer_record->id;
//        $phone_record->number = $customer->phones->number;
//        $phone_record->home_number = $customer->phones->home_number;
//        $phone_record->work_number = $customer->phones->work_number;
//        $phone_record->save(false);
//    }

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

    private function commonIndex()
    {
        $records = [];
        $customer_records = CustomerRecord::find()->all();

        foreach ($customer_records as $customer_record) {
            $phone_record = PhoneRecord::find()->where(['customer_id' => $customer_record->id])->one();
            $customer = $this->makeCustomer($customer_record, $phone_record);
            array_push($records, $customer);
        }
        return $this->wrapIntoDataProvider($records);
    }

    private function commonView($id)
    {
        $customer_record = CustomerRecord::find()->where(['id' => $id])->one();
        if (!$customer_record) {
            return 'Запись не найдена';
        }
        $phone_record = PhoneRecord::find()->where(['customer_id' => $customer_record->id])->one();
        $customer = $this->makeCustomer($customer_record, $phone_record);
        return $customer;
    }

    private function commonCreate()
    {
        $customer_record = new CustomerRecord;
        $phone_record = new PhoneRecord;

        if ($this->load($customer_record, $phone_record, \Yii::$app->request->post())) {
            $customer_record->save();
            $phone_record->customer_id = $customer_record->id;
            $phone_record->save();
            $this->redirect('/customers/index');
            return ['customer_record' => $customer_record, 'phone_record' => $phone_record];
        }

        if (\Yii::$app->getRequest()->getBodyParams()) {
            $api = \Yii::$app->getRequest()->getBodyParams();
            if (isset($api)) {
                $customer_record->name = $api['name'];
                $customer_record->birth_date = $api['birth_date'];
                $customer_record->notes = $api['notes'];

                $customer_record->save();

                $phone_record->customer_id = $customer_record->id;
                $phone_record->number = $api['number'];
                $phone_record->home_number = $api['home_number'];
                $phone_record->work_number = $api['work_number'];
                $phone_record->save();
            }
        }

        return ['customer_record' => $customer_record, 'phone_record' => $phone_record];
    }

    private function commonUpdate($id)
    {
        $customer_record = CustomerRecord::findOne($id);
        $phone_record = $customer_record->phoneRecord;

        if ($this->load($customer_record, $phone_record, \Yii::$app->request->post())) {
            $customer_record->save();
            $phone_record->save();
            $this->redirect('/customers/index');
            return ['customer_record' => $customer_record, 'phone_record' => $phone_record];
        }

        if (\Yii::$app->getRequest()->getBodyParams()) {
            $api = \Yii::$app->getRequest()->getBodyParams();
            if (isset($api)) {
                $customer_record->name = $api['name'];
                $customer_record->birth_date = $api['birth_date'];
                $customer_record->notes = $api['notes'];

                $phone_record->number = $api['number'];
                $phone_record->home_number = $api['home_number'];
                $phone_record->work_number = $api['work_number'];

                $customer_record->save();
                $phone_record->save();
            }
        }
        return ['customer_record' => $customer_record, 'phone_record' => $phone_record];
    }

    private function commonDelete($id)
    {
        $customer_record = CustomerRecord::findOne($id);
        $phone_record = $customer_record->phoneRecord;
        $phone_record->delete();
        $customer_record->delete();
    }
}