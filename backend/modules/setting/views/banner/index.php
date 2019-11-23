<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\setting\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Banners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => false,
        'tableOptions' => ['class' => 'table table-bordered table-hover contentImage'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('setting/banner/update')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'title',
            // 'description',
            // 'keywords',
            [
                'attribute'=>'content',
                'format'=>'html',
                'contentOptions' => ['class' => 'text-center','style' => 'font-size:18px;width:40%'],
            ],
            [
                'attribute'=>'content_mobile',
                'format'=>'html',
                'contentOptions' => ['class' => 'text-center','style' => 'font-size:18px;width:40%'],
            ],
            //'status',
            //'created_at',
            //'updated_at',
            //'user_add',
            //'user_edit',

             [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
                'contentOptions' => ['class' => 'actionColumn text-center','style' => 'font-size:18px'],
                'template' => '{update}',
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('setting/banner/update'),
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
