<?php

Yii::$container->set(
    app\interfaces\EmailServiceInterface::class,
    app\services\EmailService::class
);