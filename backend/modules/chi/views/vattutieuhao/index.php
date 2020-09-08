<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\VattuThSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vật tư tiêu hao';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vattu-th-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if (getUser()->manager == true): ?>
    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php endif ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Từ {begin} -> {end} trong tổng {totalCount} khoản chi",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('chi/vattutieuhao/update')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute'=>'cuahang_id',
                'value'=>'cuahang.name',
            ],
            'machi',
            'dvt',
            'status',
            'sl_dk',
            //'sl_nhap',
            //'sl_xuat',
            //'sl_ton',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i->d-m-Y']
            ],
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
