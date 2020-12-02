<?php

use \yii\widgets\DetailView;
use \yii\web\View;
use \app\models\service\ServiceRecord;

/**
 * @var View $this
 * @var ServiceRecord $model
 */

echo DetailView::widget(
    [
        'model' => $model,
        'attributes' => [
            ['attribute' => 'name'],
            ['attribute' => 'hourly_rate'],
        ],
    ]
);
