<form method="post" action="">
    <p><label>Item <input name="item" type="text"></label></p>
    <p> <label>Customer <input name="customer" type="text"></label></p>
    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->getCsrfToken() ?>"/>
    <input type="submit">
</form>

<?php

use app\modules\queue\amqp\SimpleSender;

if (isset($_POST['item']) && isset($_POST['customer'])) {
    $item = filter_input(INPUT_POST, 'item', FILTER_SANITIZE_STRING);
    $customer = filter_input(INPUT_POST, 'customer', FILTER_SANITIZE_STRING);
    $simpleSender = new SimpleSender();
    $simpleSender->execute($item . ' ' . $customer);
}

