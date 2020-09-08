<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Location */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-info']) ?>
        <?php if (Yii::$app->user->can('sanpham/location/update')): ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>
        <?php if (Yii::$app->user->can('sanpham/location/delete')): ?>
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
            'name',
            'cuahang_id',
            [
                'attribute'=>'cuahang_id',
                'value'=>$model->cuahang->name,
            ],
            'note',
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
                'value'=>$model->user->username,
            ],

        ],
    ]) ?>

</div>
