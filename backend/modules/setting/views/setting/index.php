<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\setting\models\SettingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thông tin trang web';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <!--  <p>
       <?= Html::a('Create Setting', ['create'], ['class' => 'btn btn-success']) ?>
   </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' =>false,
        // 'summary' => "Hiện {begin} -> {end} Của {totalCount} sản phẩm",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('setting/setting/update')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
              'attribute' => 'logo',
              'format' => 'html',
              'value' => function ($data) 
              {
                $url = Yii::$app->request->hostinfo.'/'.$data['logo'];
                return Html::img($url, ['alt'=>$data['title'],'width'=>'150','height'=>'50']);
              },
            ],
            'title',
            'description:ntext',
            'keyword',
            // 'talk_do',
            //'ad',
            //'footer:ntext',
            //'google_analytics',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
                'contentOptions' => ['class' => 'actionColumn','style' => 'font-size:18px'],
                'template' => '{update} {delete}',
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('setting/setting/update'),
                    'delete' => Yii::$app->user->can('setting/setting/delete')
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
