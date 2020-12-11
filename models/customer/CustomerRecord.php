<?php


namespace app\models\customer;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property \DateTime $birth_date
 * @property string $notes
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
            ['birth_date', 'string'],
            ['notes', 'safe'],
        ];
    }
}