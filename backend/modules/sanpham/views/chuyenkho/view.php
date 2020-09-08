<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductTransfer */

$this->title = 'Chuyển kho : '. $model->cuahang->name.' =>'.$model->chuyenden->name.' Ngày : '.Yii::$app->formatter->asDate($model->day, 'dd-M-Y');
$this->params['breadcrumbs'][] = ['label' => 'Product Transfers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="product-transfer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Danh sách', (!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null), ['class' => 'btn btn-success btn_luu']) ?>
        <?php if ($model->status != 2 || Yii::$app->user->identity->manager == 1): ?>
            
        <?= Html::a('Update', ['update', 'id' => $model->id_transfer], ['class' => 'btn btn-primary btn_luu']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_transfer], [
            'class' => 'btn btn-danger btn_luu',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_transfer',
            [
                'attribute' => 'day',
                'format' => ['date', 'php: d-m-Y']
            ],
            [
                'attribute'=>'cuahang_id',
                'value'=>$model->cuahang->name,
            ],
            [
                'attribute'=>'chuyenden_cuahang',
                'value'=>$model->chuyenden->name,
            ],
            [
                'attribute'=>'ketoan',
                'value'=>$model->ktoan->name,
            ],
            [
                'attribute'=>'nhanvien',
                'value'=>$model->nguoichuyen->name,
            ],
            'note',
            // 'status',
            // 'type',
            [
                'attribute' => 'status',
                'value'=>function ($data)
                {
                    $dataStatus = [0 =>'Lưu tạm',1=>'Đã chuyển chưa duyệt',2=>'Chấp nhận chuyển'];
                    return $dataStatus[$data->status];
                },
            ],
            [
                'attribute' => 'type',
                'value'=>function ($data)
                {
                    $dataStatus = [0 =>'Chuyển nội bộ',1=>'Nhập nội bộ'];
                    return $dataStatus[$data->type];
                },
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i  ->   d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i  ->   d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                'value'=>$model->user->fullname,
            ],
            [
                'attribute'=>'user_update',
                'value'=>$model->update->fullname,
            ],
        ],
    ]) ?>

    <h3>Chi tiết chuyển kho</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            // [
            //     'attribute'=>'id_transfer',
            //     'label'=>'Mã chuyển',
            // ],
            [
                'attribute'=>'pro_id',
                'value'=>'sanpham.idPro',
                'label'=>'Mã sản phẩm'
            ],
            [
                'attribute'=>'pro_id',
                'value'=>'sanpham.proName',
            ],
            [
                'attribute' =>'quantity',
                'format'=>['decimal',0],
            ],
            'note',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
