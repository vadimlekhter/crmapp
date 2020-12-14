<?php


namespace app\models\customer;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property \DateTime $birth_date
 * @property string $notes
 *
 * @property PhoneRecord $phoneRecord
 */

/**
 * Class CustomerRecord
 * @package app\controllers
 */
class CustomerRecord extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['id', 'number'],
            ['name', 'string', 'max' => 256],
            ['name', 'required'],
            ['birth_date', 'date', 'format' => 'php:Y-m-d'],
            ['notes', 'safe'],
        ];
    }

    public function getPhoneRecord()
    {
        return $this->hasOne(PhoneRecord::class, ['customer_id' => 'id']);
    }

}