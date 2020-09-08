<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\DungcuThietbi */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dungcu Thietbis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dungcu-thietbi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-info']) ?>
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
            'id',
            'madungcu',
            'name',
            'donvitinh',
            'quantity',
            'status',
            'price',
            'tongnhap',
            'tongxuat',
            'toncuoi',
            'note',
            'updated_at',
            'user_add',
        ],
    ]) ?>

</div>
