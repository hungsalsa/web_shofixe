<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Motorbike */

$this->title = $model->bikeName;
$this->params['breadcrumbs'][] = ['label' => 'Motorbikes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="motorbike-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'id',
            'bikeName',
            [
                'attribute' => 'hangxe_id',
                'value'=>$model->hang->name,
            ],
            'note:ntext',
            'status',
        ],
    ]) ?>

</div>
