<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ChiKhoanchi */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Chi Khoanchis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chi-khoanchi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-info']) ?>
        <?php if (getUser()->manager == true): ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'makhoanchi',
            'name',
            [
                'attribute'=>'donvitinh',
                'value'=>$model->dvt->unitName,
            ],
            [
                'attribute'=>'loaichi_id',
                'value'=>$model->loaichi->name,
            ],
            'status',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i->d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                'value'=>$model->user->username,
            ],
        ],
    ]) ?>

</div>
