<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quantri\models\BanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ban-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ban', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'id_tua',
            'birthday',
            'sex',
            //'relationship',
            //'phone',
            //'email:email',
            //'price_sales',
            //'loinhuan',
            //'gianet',
            //'giaban',
            //'datcoc',
            //'thanhtoan',
            //'ngayphaitt',
            //'status',
            //'note:ntext',
            //'created_at',
            //'users_add',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
