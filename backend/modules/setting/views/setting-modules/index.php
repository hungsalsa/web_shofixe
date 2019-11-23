<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\setting\models\SettingModulesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách Module tin tức';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-modules-index">

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
                . Yii::$app->urlManager->createUrl('setting/setting-modules/update')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            // 'slug',
            [
                'attribute'=>'cate_id',
                'value'=>'danhmuc.cateName',
            ],
            // 'page_show',
            'sort',
            //'positions',
            //'content:ntext',
            // 'created_at',
            [
                'attribute' => 'created_at',
                'contentOptions' => ['class' => 'text-center','style' => 'width:11%'],
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            //'updated_at',
            //'user_add',
            //'user_edit',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
                'contentOptions' => ['class' => 'actionColumn','style' => 'font-size:18px'],
                'template' => '{update} {delete}',
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('setting/setting-modules/update'),
                    'delete' => Yii::$app->user->can('setting/setting-modules/delete')
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
