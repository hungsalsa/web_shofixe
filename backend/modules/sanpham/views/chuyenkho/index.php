<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sanpham\models\ProductTransferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách chuyển kho';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-transfer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success btn_luu']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Hóa đơn từ {begin} -> {end} trong tổng {totalCount} hóa đơn",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['id_transfer'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('sanpham/chuyenkho/view')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_transfer',
            [
                'attribute' => 'day',
                'contentOptions' => ['style' => 'width: 150px;', 'class' => 'text-center text-danger font-bold'],
                'format' => ['date', 'php: d-m-Y']
            ],
            // 'cuahang_id',
            // 'chuyenden_cuahang',
            [
                'attribute'=>'cuahang_id',
                'value'=>'cuahang.name',
            ],
            [
                'attribute'=>'chuyenden_cuahang',
                'value'=>'chuyenden.name',
            ],
            [
                'attribute'=>'ketoan',
                'value'=>'ktoan.name',
            ],
            [
                'attribute'=>'nhanvien',
                'value'=>'nguoichuyen.name',
            ],
            // 'ketoan',
            //'nhanvien',
            //'note',
            'status',
            [
                'attribute' => 'status',
                'value'=>function ($data)
                {
                    $dataStatus = [0 =>'Lưu tạm',1=>'Đã chuyển chưa duyệt',2=>'Chấp nhận chuyển'];
                    return $dataStatus[$data->status];
                },
            ],
            'type',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            //'created_at',
            //'updated_at',
            //'user_add',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
