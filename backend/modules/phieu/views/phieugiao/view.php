<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuGiao */

$this->title = 'Ngày giao ' .$model->ngay_giao.' / '.$model->cuahang->name;
$this->params['breadcrumbs'][] = ['label' => 'Phieu Giaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-giao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <!-- [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Phiếu thiếu',
                'headerOptions' => ['class' => 'text-center','style'=>'width:5%'],
                'contentOptions' => ['class' => 'text-center'],
                'template' => '{my_button}', 
                'buttons' => [
                    'my_button' => function ($url, $model, $key) {
                        $phieuthieu = new PhieuThieu();
                        return Html::a($phieuthieu->getCount($model->ngay_giao,$model->cuahang_id), ['phieuthieu/create', 'id'=>$model->id], ['title' => 'Phiếu thiếu', 'target' => '_blank', 'data' => ['pjax' => 0]] );
                    },
                ],
            ], -->

    <p class="btn_save">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Phiếu thiếu', ['phieuthieu/create','id'=>$model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'ngay_giao',
                'format' => ['date', 'php: d-m-Y']
            ],
            [
                'attribute'=>'cuahang_id',
                'value'=>$model->cuahang->name,
            ],
            'sophieu_dau',
            'sophieu_cuoi',
            [
                'attribute'=>'nguoi_giao',
                'value'=>$model->nguoigiao->name,
            ],
            [
                'attribute'=>'nguoi_nhan',
                'value'=>$model->nguoinhan->name,
            ],

            'note:ntext',
            'status',
        ],
    ]) ?>

</div>
