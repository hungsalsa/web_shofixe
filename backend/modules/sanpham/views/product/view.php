<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\modules\quantri\models\Motorbike;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Product */

$this->title = $model->proName.' : '.$model->cuahang->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="pull-right btn_save">
        <?php if (Yii::$app->user->can('sanpham/product/create')): ?>
            <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-info']) ?>
        <?php endif ?>
        <?= Html::a('Danh sách SP', ['index'], ['class' => 'btn btn-success']) ?>
        <?php if (Yii::$app->user->can('sanpham/product/update')): ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>
        <?php if (Yii::$app->user->can('sanpham/product/delete')): ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'idPro',
            'proName',
            [
                'attribute'=>'cuahang_id',
                'contentOptions' => ['style' => 'width:80%'],
                'value'=>$model->cuahang->name,
            ],
            [
                'attribute'=>'cate_id',
                'value'=>$model->category->cateName,
            ],
            [
                'attribute'=>'manu_id',
                'value'=>$model->nhasanxuat->manuName,
            ],
            [
                'attribute'=>'unit',
                'value'=>$model->donvitinh->unitName,
            ],
            [
                'attribute'=>'bike_id',
                'value'=>function ($data)
                {
                    $xe = new Motorbike();
                    // $xe = $xe->getMotorName();
                    // $xe = json_decode($data->bike_id);
                    $name = '';
                    $bike =json_decode($data->bike_id);
                    if($bike){
                    foreach ($bike as $value) {
                        $name .= $xe->getMotorName($value).'-';
                    }
                    }
                    return rtrim($name,'-');
                },
                // 'value'=>$model->xesudung->bikeName,
            ],
            'proName',
            'quantity',
            [
                'attribute' =>'import_price',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'price',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'price_sale',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'cong_dv',
                'format'=>['decimal',0],
            ],
            'note:ntext',
            'status',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i / d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i / d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                // 'value'=>'user.username',
                'value'=>$model->user->username,
            ],
        ],
    ]) ?>


</div>