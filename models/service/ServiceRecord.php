<?php

namespace app\models\service;

use yii\db\Expression;
use yii\db\Query;
use yii\filters\HttpCache;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "service".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $hourly_rate
 * @property string $last_modified
 * @property int $created_at
 * @property int $updated_at
 */
class ServiceRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hourly_rate'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            ['last_modified', 'string'],
            ['created_at', 'integer'],
            ['updated_at', 'integer']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'hourly_rate' => 'Hourly Rate',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
            ],
            'httpCache' => [
                'class' => HttpCache::class,
                'only' => ['index'],
                'lastModified' => [$this, 'getMaxCustomerTimestamp'],
                'etagSeed' => [$this, 'getMaxCustomerTimestamp']
            ],
        ];
    }

    public function beforeSave($insert)
    {
        $this->last_modified = new Expression('NOW()');
        return parent::beforeSave($insert);
    }

    public function getMaxCustomerTimestamp($action, $params)
    {
        return strtotime((new Query())->from('services')->max('last_ modified'));
    }

}
