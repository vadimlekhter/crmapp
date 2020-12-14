<?php


namespace app\modules\api\controllers;

use app\traits\CustomersTrait;
use \yii\rest\Controller;

class FullCustomerController extends Controller
{
    use CustomersTrait;

    public function actionIndex()
    {
        $records = $this->commonIndex();
        return $records;
    }

    public function actionView($id)
    {
        $customer = $this->commonView($id);
        return $customer;
    }

    public function actionDelete($id)
    {
        $this->commonDelete($id);
    }

    public function actionCreate()
    {
        $customer = $this->commonCreate();
        return $customer;
    }

    public function actionUpdate($id)
    {
        $customer = $this->commonUpdate($id);
        return $customer;
    }
}