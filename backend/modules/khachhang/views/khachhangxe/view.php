<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhXe */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kh Xes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kh-xe-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'id_KH' => $model->id_KH, 'bks' => $model->bks], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'id_KH' => $model->id_KH, 'bks' => $model->bks], [
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
            'id_KH',
            'xe',
            'bks',
            'status',
            'nguoi_sd',
        ],
    ]) ?>

</div>
