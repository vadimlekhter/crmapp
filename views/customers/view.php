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
                'attribute' => 'Phone',
                'value' => function ($model) {
                    if ($model->phones->number) {
                        return $model->phones->number;
                    } else {
                        return '';
                    }
                }
            ],
            [
                'attribute' => 'Home Phone',
                'value' => function ($model) {
                    if ($model->phones->home_number) {
                        return $model->phones->home_number;
                    } else {
                        return '';
                    }
                }
            ],
            [
                'attribute' => 'Work Phone',
                'value' => function ($model) {
                    if ($model->phones->work_number) {
                        return $model->phones->work_number;
                    } else {
                        return '';
                    }
                }
            ],
        ],

    ]) ?>

</div>
