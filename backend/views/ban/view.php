<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Ban */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ban-view">

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
            'name',
            'id_tua',
            'birthday',
            'sex',
            'relationship',
            'phone',
            'email:email',
            'price_sales',
            'loinhuan',
            'gianet',
            'giaban',
            'datcoc',
            'thanhtoan',
            'ngayphaitt',
            'status',
            'note:ntext',
            'created_at',
            'users_add',
        ],
    ]) ?>

</div>
