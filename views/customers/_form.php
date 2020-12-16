<?php

use \yii\web\View;
use \yii\widgets\ActiveForm;
use \app\models\customer\CustomerRecord;
use \app\models\customer\PhoneRecord;
use yii\helpers\Html;
use \kartik\date\DatePicker;

/**
 * @var View $this
 * @var CustomerRecord $customer_record
 * @var PhoneRecord $phone_record
 */

$form = ActiveForm::begin([
    'id' => 'customer-form',
]);
//echo $form->errorSummary([$customer, $phone]);

echo $form->field($customer_record, 'name');
echo $form->field($customer_record, 'birth_date')->widget(DatePicker::class, [
    'name' => 'check_issue_date',
    'size' => 'lg',
//    'value' => date('D'),
//    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'todayHighlight' => true,
        'clearBtn' => true
    ]
]);
echo $form->field($customer_record, 'notes');

echo $form->field($phone_record, 'number');
echo $form->field($phone_record, 'home_number');
echo $form->field($phone_record, 'work_number');

echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);

ActiveForm::end();