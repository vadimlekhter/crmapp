<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\service\ServiceSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \yii\db\ActiveRecord */

app\assets\ServicesAsset::register($this);

$this->title = 'Service Records';
$this->params['breadcrumbs'][] = $this->title;

?>
    <div class="service-record-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create Service Record', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <!--        --><?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\CheckboxColumn',
                ],
//            ['class' => 'yii\grid\SerialColumn'],
//            [
//                'attribute' => 'title',
//                'value' => function (\app\models\service\ServiceRecord $model) {
//                    return $model->name;
//                }
//            ],
                'id',
                'name',
                'hourly_rate',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <button id="button">Button</button>
    <div class="service-record-index">
        <?= \yii\widgets\ListView::widget(
            [
                'options' => [
                    'class ' => 'list-view',
                    'id' => 'search_results',
                ],
                'dataProvider' => $dataProvider,
                'itemView' => '_service',
            ]
        ); ?>
    </div>

<?php

//$this->registerJsFile('/../../app/assets/services/js/index.js', [
//    'depends' => [
//        'yii\web\YiiAsset'
//    ]
//]);
