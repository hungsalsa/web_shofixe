<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\khachhang\models\KhXeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách xe của khách hàng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kh-xe-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kh Xe', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'id_KH',
                'value'=>'khachhang.name',
            ],
            [
                'attribute'=>'xe',
                'value'=>'xeKhach.bikeName',
            ],
            'bks',
            'status',
            //'nguoi_sd',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
