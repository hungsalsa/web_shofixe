<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\sanpham\models\ProductCate;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sanpham\models\ProductCateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh mục sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-cate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="pull-right btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success btn_luu']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idCate',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'cateName',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->cateName),Yii::$app->homeUrl.'sanpham/productcate/update?id='.$data->idCate);
                },

            ],
            [
                'attribute'=>'parent_id',
                'value'=> function($data){
                    // $data->parent_id;
                    if ($data->parent_id == 0) {
                        return 'root';
                    }else {
                        $cate = new ProductCate();
                        $cate = $cate->getCategoryParent();
                        return $cate[$data->parent_id];
                    }
                }
            ],
            // 'cate.cateName',
            'note:ntext',
            'status',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i / d-m-Y']
            ],
            //'created_at',
            [
                'attribute'=>'user_add',
                'value'=>'user.username',
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Actions',
              'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
              'contentOptions' => ['style' => 'font-size:18px','class'=>'actionColumn'],
              'visible'=> Yii::$app->user->isGuest ? false : true,
              'template' => '{view} {update} {delete}',
              'visibleButtons' => [
                    'view' => Yii::$app->user->can('sanpham/product/view'),
                    'update' => Yii::$app->user->can('sanpham/product/update'),
                    'delete' => Yii::$app->user->can('sanpham/product/delete')
                ]
            ]
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
