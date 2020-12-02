<?php

namespace app\services;

use app\interfaces\EmailServiceInterface;
use yii\base\Component;

class EmailService extends Component implements EmailServiceInterface
{
    public function send($to, $subject, $data, $views)
    {

        if (\Yii::$app->mailer->compose(
            $views,
            $data,
        )
            ->setTo($to)
            ->setSubject($subject)
            ->send()) {
            return true;
        }
        return false;
    }
}