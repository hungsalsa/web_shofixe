<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductCate */

$this->title = 'Danh mục sản phẩm : '.$model->cateName;
$this->params['breadcrumbs'][] = ['label' => 'Product Cates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-cate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="pull-right button_save">
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-success button_luu']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->idCate], ['class' => 'btn btn-primary button_luu']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idCate], [
            'class' => 'btn btn-danger button_luu',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idCate',
            'cateName',
            [
                'attribute'=>'parent_id',
                'value'=>$model->parent->cateName,
            ],
            'note:ntext',
            'status',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i <--> d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i <--> d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                'value'=>$model->user->username,
            ],
        ],
    ]) ?>

</div>
