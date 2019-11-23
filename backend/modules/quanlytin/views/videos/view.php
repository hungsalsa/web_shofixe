<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\Videos */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="btn_save">
        <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Chỉnh sửa', ['update', 'id' => $model->idVideo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa Video', ['delete', 'id' => $model->idVideo], [
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
            // 'idVideo',
            'name',
            [
                'attribute'=>'category_id',
                'value'=>$model->danhmuc->cateName,
            ],
            'sort',
            [
                'format' => 'raw',
                'attribute'=>'link',
                'value' => !empty($model->link) ? '<iframe class="embed-responsive-item" src="'.$model->link.'" frameborder="0" allowfullscreen></iframe>' : null,
            ],
            'seo_title',
            'seo_description',
            'status',
            'content:html',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'value' => $model->userAdd->username
            ],
            [
                'attribute' => 'user_edit',
                'value' => (isset($model->userEdit->username)) ?$model->userEdit->username : "Chưa sửa"
            ],
        ],
    ]) ?>

</div>
