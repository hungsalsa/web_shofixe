<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Chingay */

$this->title = $model->cuahang->name.' / '.Yii::$app->formatter->asDate($model->day, 'dd-M-Y');
$this->params['breadcrumbs'][] = ['label' => 'Chingays', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chingay-view">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            [
                'attribute' => 'day',
                'format' => ['date', 'php: d-m-Y']
            ],
            [
                'attribute'=>'cuahang_id',
                'value'=>$model->cuahang->name,
            ],
            [
                'attribute'=>'nguoi_chi',
                'value'=>$model->ketoan->name,
            ],
            [
                'attribute'=>'nguoimua',
                'value'=>$model->muahang->name,
            ],
            [
                'attribute'=>'kieunhap',
                // 'value'=>$model->muahang->name,
            ],
            [
                'attribute'=>'total_money',
                'format'=>['decimal',0],
                // 'value'=>$model->total_money*1000,
            ],
            'note:ntext',
            [
                'attribute' => 'status',
                'value'=>function ($data)
                {
                    $dataStatus = [0 =>'Lưu tạm',1=>'Đã xuất'];
                    return $dataStatus[$data->status];
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
                'value'=>$model->user->username,
            ],
        ],
    ]) ?>

    <h3 class="text-info text-center">Chi tiết chi </h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => "có {begin} -> {end} trong tổng {totalCount} khoản chi",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute'=>'name',
                'value'=>'khoanchi.makhoanchi',
                'label'=>'Mã khoản chi',
            ],
            [
                'attribute'=>'name',
                'value'=>'khoanchi.name',
                // 'label'=>'Mã sản phẩm',
            ],
            
            
            [
                'attribute'=>'quantity',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'money',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'motorbike',
                'value'=>'xe.bikeName',
            ],
            [
                'attribute'=>'ncc_id',
                'value'=>'ncc.supName',
            ]
            // 'note',
            //'user_update',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
