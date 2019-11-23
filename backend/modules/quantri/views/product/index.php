<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use  backend\modules\quantri\models\ProductCategory;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quantri\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Hiện {begin} -> {end} Của {totalCount} sản phẩm",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('quantri/productcategory/update')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
               'attribute' => 'pro_name',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->pro_name),Yii::$app->homeUrl.'quantri/product/view?id='.$data->id);
                },
            ],
            // 'title',
            'slug',
            // 'keyword:ntext',
            //'description:ntext',
            //'short_introduction:ntext',
            //'content:ntext',
            //'price',
            'price_sales',
            //'start_sale',
            //'end_sale',
            'order',
            'active',
            //'product_type_id',
            //'salse',
            //'hot',
            //'best_seller',
            'manufacturer_id',
            //'guarantee',
            'models_id',
            //'views',
            //'code',
            'image',
            //'images_large',
            //'tags',
            [
               'attribute' => 'product_category_id',
               'format' => 'raw',
               'value'=>function ($data) {
                $cate = new ProductCategory();
                $dataCate = $cate->getCategoryParent();
                return $dataCate[$data->product_category_id];
                },
            ],
            //'related_articles',
            //'related_products',
            //'created_at',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i  ->   d-m-Y']
            ],
            //'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
