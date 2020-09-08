<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Các phiếu thiếu của cửa hàng bạn: ';
$this->params['breadcrumbs'][] = $this->title;
// $phieu = new PhieuSophieu();

?>
<div class="phieu-thieu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                . Yii::$app->urlManager->createUrl('phieu/phieuthieu/view')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'cuahang_id',
                'value'=>'cuahang.name'
            ],
            'ngay_giao',
            'so_phieu',
            // [
            //     'attribute' => 'so_phieu',
            //     // 'format' => 'raw',
            //     'value'=>function ($data) {
            //         return implode(" / ",json_decode($data->so_phieu));
            //     },

            // ],
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('phieu/phieugiao/view'),
                    'update' => Yii::$app->user->can('phieu/phieugiao/update'),
                    'delete' => Yii::$app->user->can('phieu/phieugiao/delete'),
                ]
            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
