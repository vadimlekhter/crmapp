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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" crossorigin="anonymous"></script>
</head>
<body>
<?php $this->beginBody() ?>
<div class="authorization-indicator">
    <?php if (Yii::$app->user->isGuest): ?>
        <?= Html::tag('span', 'guest'); ?>
        <?= Html::a('login', '/site/login'); ?>
    <?php else: ?>
        <?= Html::tag('span', Yii::$app->user->identity->username); ?>
        <?= Html::a('logout', '/site/logout'); ?><?php endif; ?>
</div>
<div class="container">
    <?= Alert::widget() ?>
    <?php
    /* @var $content string */
    echo $content;
    ?>
    <!--    <footer class="footer">--><? //= Yii::powered(); ?><!--</footer>-->
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
