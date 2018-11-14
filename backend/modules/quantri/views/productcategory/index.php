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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idCate',
            // 'title',
            [
               'attribute' => 'cateName',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->cateName),Yii::$app->homeUrl.'quantri/productcategory/update?id='.$data->idCate);
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
            //'home_page',
            //'image',
            'order',
            'active',
            //'created_at',
            //'updated_at',
            //'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
