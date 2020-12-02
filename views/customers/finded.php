<?php

use \yii\widgets\ListView;
use \yii\web\View;
use \yii\data\ArrayDataProvider;

/**
 * @var View $this
 * @var ArrayDataProvider $records
 */

echo ListView::widget(
    [
        'options' => [
            'class ' => 'list-view',
            'id' => 'search_results',
        ],
        'dataProvider' => $records,
        'itemView' => '_customer',
    ]
);