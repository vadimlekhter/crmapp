<form method="post" action="">
    <label>
        <input name="theName" type="text">
        <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
    </label>
    <input type="submit">
</form>

<?php

use app\modules\queue\amqp\SimpleSender;

if (isset($_POST['theName'])) {
    $theName = filter_input(INPUT_POST, 'theName', FILTER_SANITIZE_STRING);
    $simpleSender = new SimpleSender();
    $simpleSender->execute($theName);
}

