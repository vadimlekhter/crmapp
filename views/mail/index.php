<?php

use yii\bootstrap\ActiveForm;
use \app\models\mail\MailForm;
use yii\web\View;
use yii\helpers\Html;

/**
 * @var View $this
 * @var  MailForm $model
 */
?>

<div class="mail-form">
    <?php

    $form = ActiveForm::begin(['id' => 'mail-form']);

    echo $form->field($model, 'to')->textInput();
    echo $form->field($model, 'subject')->textInput();
    echo $form->field($model, 'message')->textInput();

    echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);

    ActiveForm::end();

    ?>
</div>