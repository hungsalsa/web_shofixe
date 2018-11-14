<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quantri\models\ModelsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Models');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="models-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Thêm mới xe'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
               'attribute' => 'name',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->name),Yii::$app->homeUrl.'quantri/models/update?id='.$data->id);
                },
            ],
            'parent_id',
            'keyword',
            'description:ntext',
            //'short_introduction:ntext',
            //'title',
            //'slug',
            //'active',
            //'order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
