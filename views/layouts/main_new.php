<?php

use yii\helpers\Html;
use app\widgets\Alert;

app\assets\MyMainAsset::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= Html::csrfMetaTags() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="container">
    <div class="authorization-indicator">
        <?php if (Yii::$app->user->isGuest): ?>
            <?= Html::tag('span', 'guest'); ?>
            <?= Html::a('enter', '/site/login'); ?>
        <?php else: ?>
            <?= Html::tag('span', Yii::$app->user->identity->username); ?>
            <?= Html::a('exit', '/site/logout'); ?><?php endif; ?>
    </div>
    <?= Alert::widget() ?>
    <?php
    /* @var $content string */
    echo $content;
    ?>
        <footer class="footer"><? //= Yii::powered(); ?></footer>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
