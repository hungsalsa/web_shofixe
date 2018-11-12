<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Product */

$this->title = $model->pro_name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

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
            'pro_name',
            'title',
            'slug',
            'keyword:ntext',
            'description:ntext',
            'short_introduction:ntext',
            'content:ntext',
            'price',
            'price_sales',
            'start_sale',
            'end_sale',
            'order',
            'active',
            'product_type_id',
            'salse',
            'hot',
            'best_seller',
            'manufacturer_id',
            'guarantee',
            'models_id',
            'views',
            'code',
            'image',
            'images_list',
            'tags',
            'product_category_id',
            'related_articles',
            'related_products',
            'created_at',
            'updated_at',
            'user_id',
        ],
    ]) ?>

</div>
