<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\quantri\models\Motorbike;

$this->title = $model->tendv;
$this->params['breadcrumbs'][] = ['label' => 'Khachhang Dichvu Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$user = Yii::$app->user->identity
?>
<div class="khachhang-dichvu-list-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="pull-right">
        <?php if (Yii::$app->user->can('khachhang/danhsachdichvu/create')): ?>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-info button_luu']) ?>
        <?php endif ?>
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-success button_luu']) ?>
        <?php if (Yii::$app->user->can('khachhang/danhsachdichvu/update') && $model->phutung!=1): ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], [
                'class' => 'btn btn-primary button_luu',
                'data' => [
                    'confirm' => 'Dịch vụ này thuộc phụ tùng, khi sửa có thể bị sai kho hàng. Bạn có sửa ?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif ?>
        <?php if (Yii::$app->user->can('khachhang/danhsachdichvu/delete')): ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger button_luu',
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
            // 'id',
            'madichvu',
            'tendv',
            'price',
            'phutung',
            [
                'attribute'=>'xe_sd',
                'value'=>function ($data)
                {
                    if ($data->xe_sd == '') {
                        return '';
                    }else {
                        $bike = new Motorbike();
                        return $bike->ReturnBikename(json_decode($data->xe_sd));
                    }
                }
            ],
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
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i  ->   d-m-Y']
            ],
            [
                'attribute' => 'user_add',
                'value'=>$model->user->fullname,
            ],
        ],
    ]) ?>

</div>
