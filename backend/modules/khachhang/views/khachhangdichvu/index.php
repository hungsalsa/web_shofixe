<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\khachhang\models\KhDichvuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dịch vụ khách hàng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kh-dichvu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Phiếu từ {begin} -> {end} trong tổng {totalCount} phiếu dịch vụ",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['iddv'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('khachhang/khachhangdichvu/view')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'iddv',
            [
                'attribute' => 'day',
                'contentOptions' => ['style' => 'width: 130px;color:#ff0000', 'class' => 'font-bold'],
                'format' => ['date', 'php:d-m-Y']
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'cuahang_id',
                'format' => 'raw',
                'contentOptions' => ['style' => 'width: 130px;', 'class' => 'text-info font-bold'],
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->cuahang->name),Yii::$app->homeUrl.'khachhang/khachhangdichvu/update?id='.$data->iddv);
                },

            ],
            
            [
                'attribute'=>'id_kh',
                'value'=>'khachhang.name'
            ],
            [
                'attribute'=>'id_xe',
                'value'=>'xesua.bks'
            ],
            [
                'attribute'=>'total_money',
                'format'=>['decimal',0],
                // 'value'=>'xesua.bks'
            ],
            'sophieu',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i->d-m-Y']
            ],
            //'id_nhanvien',
            //'id_ketoan',
            //'id_quanly',
            //'note',
            [
                'attribute'=>'status',
                'value'=>function($data){
                    $status = [0=>'Lưu tạm',1=>'Đã xuất',2=>'Chưa thanh toán'];
                    return $status[$data->status];
                }
            ],
            //'created_at',
            //'updated_at',
            [
                'attribute'=>'user_add',
                'value'=>'user.fullname'
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
                'contentOptions' => ['class' => 'actionColumn','style' => 'font-size:18px'],
                'template' => '{view} {update} {delete}',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('khachhang/khachhangdichvu/view'),
                    'update' => Yii::$app->user->can('khachhang/khachhangdichvu/update'),
                    'delete' => Yii::$app->user->can('khachhang/khachhangdichvu/delete')
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
