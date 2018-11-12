<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\setting\models\MenusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Menus', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'name',
            [
               'attribute' => 'name',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->name),Yii::$app->homeUrl.'setting/menus/update?id='.$data->id);
                },
            ],
             'title',
            'slug',
            'type',
            'link_cate',
            'parent_id',
            // 'introduction:ntext',
            'order',
            //'image',
            'status',
            //'created_at',
            //'updated_at',
            //'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
