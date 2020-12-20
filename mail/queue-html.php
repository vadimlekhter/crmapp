<?php
use yii\helpers\Html;
use yii\helpers\Url;

/** @var $message string */

?>

<h2>Письмо от crmapp</h2>

<?php
echo Html::tag('p', 'Привет!');
echo Html::tag('p', $message);
