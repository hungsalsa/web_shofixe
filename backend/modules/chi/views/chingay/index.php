<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\ChingaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Các khoản chi khác';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chingay-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success btn_luu']) ?>
    </p>

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
                . Yii::$app->urlManager->createUrl('chi/chingay/view')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'day',
                'format' => ['date', 'php: d-m-Y']
            ],
            [
                'attribute'=>'cuahang_id',
                'value'=>'cuahang.name',
            ],
            [
                'attribute'=>'nguoi_chi',
                'value'=>'ketoan.name',
            ],
            [
                'attribute'=>'nguoimua',
                'value'=>'muahang.name',
            ],
            'total_money',
            'kieunhap',
            //'note:ntext',
            //'status',
            //'created_at',
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
