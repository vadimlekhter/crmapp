<?php


namespace app\modules\api\models;


use app\models\service\ServiceRecord;

class Service extends ServiceRecord
{
    public function fields()
    {
        return [
            'ID' => 'id',
            'Name' => 'name',
            'Hourly Rate' => 'hourly_rate'
        ];
    }

    public function extraFields()
    {
        return parent::extraFields(); // TODO: Change the autogenerated stub
    }
}