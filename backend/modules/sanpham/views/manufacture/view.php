<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Manufacture */

$this->title = 'Tên nhà sản xuất : '. $model->manuName;
$this->params['breadcrumbs'][] = ['label' => 'Manufactures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacture-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-info btn_active']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn_active']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn_active',
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
            'manuName',
            'address',
            'phone',
            'note:ntext',
            'status',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i / d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i / d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                // 'value'=>'user.username',
                'value'=>$model->user->username,
            ],
        ],
    ]) ?>

</div>
