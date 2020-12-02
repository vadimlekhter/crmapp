<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\customer\Customer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customer Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="service-record-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                    return $model->phones->number;
                }
            ],
            [
                'attribute' => 'Home Phone',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->phones->home_number;
                }
            ],
            [
                'attribute' => 'Work Phone',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->phones->work_number;
                }
            ],
        ],

    ]) ?>

</div>
