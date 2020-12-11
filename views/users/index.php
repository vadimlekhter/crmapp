<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\user\UserSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Records';
$this->params['breadcrumbs'][] = $this->title;
\app\assets\UsersAsset::register($this);
?>
<div class="user-record-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div id="search_div">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div id="search_button_div">
        <button id="search_button" class="btn btn-danger">Поиск</button>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
