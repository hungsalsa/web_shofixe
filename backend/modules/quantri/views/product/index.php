<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pro_name',
            'title',
            // 'slug',
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
            //'images_list',
            //'tags',
            'product_category_id',
            //'related_articles',
            //'related_products',
            //'created_at',
            'updated_at',
            //'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
