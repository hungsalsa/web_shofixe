<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('User List', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php if ($model->id==getUser()->id): ?>
            <?= Html::a('Đổi mật khẩu', ['changepassword'], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'fullname',
            [
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($data) {
                    return Html::img($data['image'],
                        ['width' => '220px']);
                },
            ],
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            'cuahang_id',
            'status',
            // 'created_at',
            // 'updated_at',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
        ],
    ]) ?>

</div>
