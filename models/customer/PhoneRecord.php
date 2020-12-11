<?php


namespace app\models\customer;

use yii\db\ActiveRecord;


/**
 * Class PhoneRecord
 * @package app\controllers
 */
class PhoneRecord extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'phone';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['id', 'number'],
            ['customer_id', 'number'],
            ['customer_id', 'required'],
            ['number', 'string'],
            ['home_number', 'string'],
            ['work_number', 'string'],
        ];
    }
}