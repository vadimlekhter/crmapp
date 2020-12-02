<?php

use \yii\web\View;
use \yii\widgets\ActiveForm;
use \app\models\customer\CustomerRecord;
use \app\models\customer\PhoneRecord;
use yii\helpers\Html;

/**
 * @var View $this
 * @var CustomerRecord $customer
 * @var PhoneRecord $phone
 */
$form = ActiveForm::begin([
    'method' => 'get',
    'action' => '/customers/finded'
]);

echo Html::textInput('phone_number');

echo Html::submitButton( 'Search', ['class' => 'btn btn-primary']);

ActiveForm::end();