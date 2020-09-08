<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuThieu */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Phieu Thieus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$perrUpdate = (Yii::$app->user->can('phieu/phieuthieu/update'))?'':'hidden';
$perrDelete = (Yii::$app->user->can('phieu/phieuthieu/delete'))?'':'hidden';
?>
<div class="phieu-thieu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => "btn btn-primary $perrUpdate"]) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger '.$perrDelete,
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
            'ngay_giao',
            'cuahang_id',
            'so_phieu',
            'note:ntext',
            'status',
            'created_at',
            'updated_at',
            'user_add',
        ],
    ]) ?>

</div>
