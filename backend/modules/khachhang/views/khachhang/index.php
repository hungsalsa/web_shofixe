<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\khachhang\models\KhachHangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách khách hàng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khach-hang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success button_luu']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Khách hàng từ {begin} -> {end} trong tổng {totalCount} khách hàng",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['idKH'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('khachhang/khachhang/view')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'idKH',
            'name',
            'phone',
            'address',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Phiếu thiếu',
                'headerOptions' => ['class' => 'text-center','style'=>'width:10%'],
                'contentOptions' => ['class' => 'text-center'],
                'template' => '{my_button}', 
                'buttons' => [
                    'my_button' => function ($url, $model, $key) {
                        // $phieuthieu = new PhieuThieu();
                        return Html::a('Thêm dịch vụ', ['khachhangdichvu/create', 'idKH'=>$model->idKH], ['title' => 'Phiếu thiếu', 'data' => ['pjax' => 0]] );
                        // return 'thêm phiếu dv';
                    },
                ],
            ],
            // 'created_at',
            //'note',
            //'status',
            //'updated_at',
            //'user_add',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i  ->   d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                'value'=>'user.fullname',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'options'=>['style'=>'width:4%'],
                'header' => 'Action',
                'contentOptions' => ['class'=>'text-center'],
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('khachhang/khachhang/view'),
                    'update' => Yii::$app->user->can('khachhang/khachhang/update'),
                    'delete' => Yii::$app->user->can('khachhang/khachhang/delete')
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
