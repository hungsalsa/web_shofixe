<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sanpham\models\ManufactureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách nhà sản xuất';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacture-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success btn_active']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Hiển thị {begin} -> {end} trong tổng {totalCount} nhà sản xuất",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                // 'id' => $model['idPro'], 
                // 'cuahang_id' => $model['cuahang_id'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('sanpham/manufacture/view?id='.$model->id).'"'
                // . '&id="+(this.cuahang_id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'manuName',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->manuName),Yii::$app->homeUrl.'sanpham/motorbike/update?id='.$data->id);
                },

            ],
            'address',
            'phone',
            'note:ntext',
            //'status',
            //'created_at',
            //'updated_at',
            //'user_add',

            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Actions',
              'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
              'contentOptions' => ['style' => 'font-size:18px','class'=>'actionColumn'],
              'visible'=> Yii::$app->user->isGuest ? false : true,
              'template' => '{view} {update} {delete} ',
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
