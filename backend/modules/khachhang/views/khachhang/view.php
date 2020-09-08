<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhachHang */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Khach Hangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khach-hang-view">

    <h1 class="pull-left"><?= Html::encode($this->title) ?></h1>

    <p class="pull-right btn_save">
        <?= Html::a('Tạo dịch vụ', ['/khachhang/khachhangdichvu/create', 'idKH' => $model->idKH], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Thêm mới khách hàng', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->idKH], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->can('khachhang/khachhang/delete')): ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->idKH], [
                'class' => 'btn btn-danger',
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
            'idKH',
            'name',
            'phone',
            'address',
            'age',
            'job',
            'facebook',
            'email',
            [
                'attribute' => 'birthday',
                'format' => ['date', 'php:d-m-Y']
            ],
            'note:html',
            // 'status',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                'value'=>function($data){
                    if($data->user->fullname !=''){
                        return $data->user->fullname;
                    }else {
                        return $data->user->username;
                    }
                    
                }
            ],
        ],
    ]) ?>

    <h3>Chi tiết Xe khách hàng</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            // 'id_KH',
            [
                'attribute'=>'xe',
                'value'=>'xeKhach.bikeName',
            ],
            'bks',
            'color',
            'nguoi_sd',
            'quanhe',
            // [
            //     'attribute'=>'status',
            //     'value'=>function ($data)
            //     {
            //         $status = [0=>'Không sử dụng',1=>'Đang sử dụng'];
            //         return $status[$data->status];
            //     },
            // ],


            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
