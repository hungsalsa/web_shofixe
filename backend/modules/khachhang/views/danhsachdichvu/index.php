<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\quantri\models\Motorbike;

$this->title = 'Danh sách dịch vụ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khachhang-dichvu-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới dịch vụ', ['create'], ['class' => 'btn btn-success button_luu']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Dịch vụ từ {begin} -> {end} trong tổng {totalCount} dịch vụ",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        // 'rowOptions' => function ($model, $key, $index, $grid) {
        //     return [
        //         'style' => "cursor: pointer",
        //         'id' => $model['id'], 
        //         'onclick' => 'location.href="'
        //         . Yii::$app->urlManager->createUrl('khachhang/danhsachdichvu/view')
        //         . '?id="+(this.id);',
        //     ];
        // },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'madichvu',
            'tendv',
            'price',
            'price_sale',
            'guarantee',
            'phutung',
            [
                'attribute'=>'status',
                'headerOptions' => ['style'=>'width:6%'],
                'value'=>function($data){
                    $dataStatus = [0=>'Ẩn',1=>'kích hoạt'];
                    return $dataStatus[$data->status];
                },
                'filter' =>[0=>'Ẩn',1=>'kích hoạt'],
            ],
            [
                'attribute'=>'xe_sd',
                'value'=>function ($data)
                {
                        $bike = new Motorbike();
                        return $bike->ReturnBikename(json_decode($data->xe_sd));
                }
            ],
            [
                'attribute' => 'user_add',
                'value'=>'user.fullname',
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i->d-m-Y']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('khachhang/danhsachdichvu/view'),
                    'update' => Yii::$app->user->can('khachhang/danhsachdichvu/update'),
                    'delete' => Yii::$app->user->can('khachhang/danhsachdichvu/delete')
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
