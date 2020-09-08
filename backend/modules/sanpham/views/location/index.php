<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sanpham\models\LocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách vị trí kho của bạn';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới vị trí', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute'=>'cuahang_id',
                'value'=>'cuahang.name',
            ],
            'note',

            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                'value'=>'user.username',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 6%'],
                'contentOptions' => ['class' => 'actionColumn text-center','style' => 'font-size:18px'],
                'template' => '{view} {update} {delete}',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('sanpham/location/view'),
                    'update' => Yii::$app->user->can('sanpham/location/update'),
                    'delete' => Yii::$app->user->can('sanpham/location/delete')
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
