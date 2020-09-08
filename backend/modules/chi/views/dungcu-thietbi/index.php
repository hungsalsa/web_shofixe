<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\DungcuThietbiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách dụng cụ thiết bị';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dungcu-thietbi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'madungcu',
            'name',
            'donvitinh',
            'quantity',
            //'status',
            //'price',
            //'tongnhap',
            //'tongxuat',
            //'toncuoi',
            //'note',
            //'updated_at',
            //'user_add',

            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Actions',
              'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
              'contentOptions' => ['style' => 'font-size:18px','class'=>'actionColumn'],
              'visible'=> Yii::$app->user->isGuest ? false : true,
              'template' => '{view} {update} {delete} ',
              'visibleButtons' => [
                    'view' => Yii::$app->user->can('sanpham/product/view'),
                    'update' => Yii::$app->user->can('sanpham/product/update'),
                    'delete' => Yii::$app->user->can('sanpham/product/delete')
                ]
            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
