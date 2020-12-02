_cus<?php

use \yii\widgets\DetailView;
use \yii\web\View;
use app\models\customer\Customer;

/**
 * @var View $this
 * @var Customer $model
 */

echo DetailView::widget(
    [
        'model' => $model,
        'attributes' => [
            'name',
            'notes',
            [
                'attribute' => 'Дата рождения',
                'format' => 'html',
                'value' => function ($model) {
                    return $model->birth_date->format('Y-m-d');
                }
            ],
            [
                'attribute' => 'Mobile Phone',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->phones[0]->number;
                }
            ],
            [
                'attribute' => 'Home Phone',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->phones[0]->home_number;
                }
            ],
            [
                'attribute' => 'Work Phone',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->phones[0]->work_number;
                }
            ],
    ]
]);
