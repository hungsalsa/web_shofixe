<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quantri\models\ProductCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use backend\modules\quantri\models\ProductCategory;
$this->title = 'Danh mục sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Hiện {begin} -> {end} Của {totalCount} danh mục",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['idCate'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('quantri/productcategory/update')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idCate',
            // 'title',
            [
               'attribute' => 'cateName',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->cateName),Yii::$app->homeUrl.'quantri/productcategory/view?id='.$data->idCate);
                },
            ],
            // 'group_id',
            [
                'attribute'=>'cate_parent_id',
                'value'=>function ($data)
                {
                    $model = new ProductCategory();
                    $dataCate = $model->getCategoryParent();
                    if($data->cate_parent_id == 0){
                        return 'root';
                    }else {
                        return $dataCate[$data->cate_parent_id];
                    }
                }
            ],
            // 'cate_parent_id',
            'slug',
            //'keyword:ntext',
            //'description:ntext',
            //'content:ntext',
            //'short_introduction:ntext',
            'home_page',
            //'image',
            'order',
            'active',
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
