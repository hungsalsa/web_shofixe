<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Hangxe */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hangxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hangxe-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> 
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
            'name',
            'note',
        ],
    ]) ?>

</div>
