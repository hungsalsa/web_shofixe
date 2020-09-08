<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\phieu\models\PhieuThieu;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\phieu\models\PhieuGiaoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách phiếu giao';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-giao-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Giao thêm phiếu', ['create'], ['class' => 'btn btn-success btn_luu']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Từ {begin} -> {end} trong tổng {totalCount} lần giao phiếu",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('phieu/phieugiao/view')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'ngay_giao',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'ngay_giao',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode(Yii::$app->formatter->asDatetime($data->ngay_giao,"php:d-m-Y")),Yii::$app->homeUrl.'phieu/phieugiao/update?id='.$data->id);
                },

            ],
            // 'cuahang_id',
            [
                'attribute' => 'cuahang_id',
                'value'=>'cuahang.name'
            ],
            'sophieu_dau',
            'sophieu_cuoi',
            [   
                'attribute'=>'nguoi_giao',
                'value'=>'nguoigiao.name',
            ],
            [
                'attribute'=>'nguoi_nhan',
                'value'=>'nguoinhan.name',
            ],
            //'nguoi_nhan',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Phiếu thiếu',
                'headerOptions' => ['class' => 'text-center','style'=>'width:5%'],
                'contentOptions' => ['class' => 'text-center'],
                'template' => '{my_button}', 
                'buttons' => [
                    'my_button' => function ($url, $model, $key) {
                        $phieuthieu = new PhieuThieu();
                        return Html::a($phieuthieu->getCount($model->ngay_giao,$model->cuahang_id), ['phieuthieu/create', 'id'=>$model->id], ['title' => 'Phiếu thiếu', 'target' => '_blank', 'data' => ['pjax' => 0]] );
                    },
                ],
            ],
            // 'status',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i/d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                'value'=>'user.username',
            ],
            //'note:ntext',
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
