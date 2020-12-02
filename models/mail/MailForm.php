<?php


namespace app\models\mail;


use yii\base\Model;

class MailForm extends Model
{
    /**
     * @var string
     */
    public $to;
    /**
     * @var string
     */
    public $subject;
    /**
     * @var string
     */
    public $message;

    public function rules()
    {
        return [
            ['to', 'required'],
            ['to', 'email'],
            ['subject', 'string'],
            ['message', 'string'],
            ['message', 'required']
        ];
    }
}