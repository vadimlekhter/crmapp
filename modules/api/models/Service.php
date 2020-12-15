<?php


namespace app\modules\api\models;


use app\models\service\ServiceRecord;

class Service extends ServiceRecord
{
    public function fields()
    {
        return [
            'Work/Price' => function ($model) {
                return $model->name . ' - ' . $model->hourly_rate;
            },
            'ID' => 'id',
            'Name' => 'name',
            'Hourly Rate' => 'hourly_rate'
        ];
    }

    public function extraFields()
    {
        return [
            "Id" => 'id'
        ];
    }
}