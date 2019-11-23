<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quanlytin\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách danh mục tin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Từ {begin} -> {end} trong tổng {totalCount} danh mục",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('quanlytin/categories/update')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => 'STT'],

            // 'id',
            'cateName',
            // 'groupId',
            [
                'attribute'=>'parent_id',
                // 'value'=>'parent.cateName'
                'value' => function ($data){
                    return $data->parent_id==0 ?  "Không": $data->parent->cateName;
               }
            ],
            // 'slug',
            'sort',
            //'seo_title',
            //'keyword',
            //'seo_descriptions:ntext',
            // [
            //     'attribute' => 'status',
            //     // 'value'=>'trangthai.name'
            //     'format'=>'raw',
            //     'value'=>function($data){
            //         // return  Html::a($data->trangthai->name, ['categories/changestatus/','id'=> $data->id], ['class' => 'btn btn-primary changeStatus','current_status'=>$data->id,'field'=>'status']);
            //         return Html::a($data->trangthai->name, ['categories/updatestatus', 'id' => $data->id], ['class' => 'btn btn-primary changeStatus','current_status'=>$data->id,'field'=>'status']);
            //         // return  Html::a($data->trangthai->name, ['categories/changestatus/','id'=> $data->id], ['class' => 'btn btn-primary changeStatus','current_status'=>$data->id,'field'=>'status']);
            //     }
            // ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            //'content',
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute'=>'userAdd',
                'value'=>'userad.username'
            ],
            
            [
                'attribute'=>'user_edit',
                'value'=>'usered.username'
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
                'contentOptions' => ['class' => 'actionColumn','style' => 'font-size:18px'],
                'template' => '{update} {delete}',
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('quanlytin/categories/update'),
                    'delete' => Yii::$app->user->can('quanlytin/categories/delete')
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
