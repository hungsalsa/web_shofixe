<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\ProductCategory */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Product Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idCate], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idCate], [
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
            'idCate',
            'title',
            'cateName',
            'group_id',
            'cate_parent_id',
            'slug',
            'keyword:ntext',
            'description:ntext',
            'content:ntext',
            'short_introduction:ntext',
            'home_page',
            'image',
            'order',
            'active',
            'created_at',
            'updated_at',
            'user_id',
        ],
    ]) ?>

</div>
