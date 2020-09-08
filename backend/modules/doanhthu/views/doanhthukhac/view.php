<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\DoanhthuKhac */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Doanhthu Khacs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doanhthu-khac-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'doanhthu_id',
            'name',
            'money',
            'note:ntext',
        ],
    ]) ?>

</div>
