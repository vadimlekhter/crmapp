<?php

use yii\widgets\ListView;
use \yii\web\View;
use \yii\data\ArrayDataProvider;
use yii\helpers\Html;

/**
 * @var View $this
 * @var ArrayDataProvider $records
 */

echo \yii\grid\GridView::widget(
    [
        'dataProvider' => $records,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'birth_date:date',
            'notes',
//            'phones.0.number:text:Phones',
            [
                'label' => 'Mobile Phone',
//                'attribute' => 'project_id',

                'content' => function ($model) {
                    if (isset($model->phones->number)) {
                        return $model->phones->number;
                    } else {
                        return null;
                    }
                },

                'format' => 'html',

            ],
            [
                'label' => 'Home Phone',
//                'attribute' => 'project_id',

                'content' => function ($model) {
                    if (isset($model->phones->home_number)) {
                        return $model->phones->home_number;
                    } else {
                        return null;
                    }
                },

                'format' => 'html',

            ],
            [
                'label' => 'Work Phone',
//                'attribute' => 'project_id',

                'content' => function ($model) {
                    if (isset($model->phones->work_number)) {
                        return $model->phones->work_number;
                    } else {
                        return null;
                    }
                },

                'format' => 'html',

            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        $icon = \yii\bootstrap\Html::icon('hand-right');
                        return Html::a($icon, ['customers/view', 'name' => $model->name],
                            ['data' => [
                                'confirm' => 'View customer?',
                                'method' => 'post'
                            ]]
                        );
                    },
                ],
            ],
        ]
    ]
);


//echo ListView::widget(
//    [
//        'options' => [
//            'class ' => 'list-view',
//            'id' => 'search_results',
//        ],
//        'dataProvider' => $records,
//        'itemView' => '_customer',
//    ]
//);