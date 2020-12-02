<?php

use yii\bootstrap\ActiveForm;
use app\models\user\LoginForm;
use \yii\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var LoginForm $model
 */

$form = ActiveForm::begin(['id' => 'login-form']);

echo $form->field($model, 'username')->textInput([['maxlength' => true]]);

echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);

echo $form->field($model, 'rememberMe')->checkbox();

echo Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']);

ActiveForm::end();