<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\detail\DetailView;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quantri\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách các trang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới trang', ['create'], ['class' => 'btn btn-success']) ?>
        <span class="pull-right">Tổng số : <?=$dataProvider->getTotalCount(); ?> trang</span>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
               'attribute' => 'name',
               'format' => 'raw',
               'value'=>function ($data) {
                return Html::a(Html::encode($data->name),Yii::$app->homeUrl.'quanlytin/pages/update?id='.$data->id);
                },
            ],
            'title',
            // 'slug',
            // 'short_introduction:ntext',
            // 'status',
            [
                'attribute' => 'status',
                'value'=>function($data){
                    if($data->status==1){
                        return "Kích hoạt";
                    }else{
                        return "Không kích hoạt";
                    }
                },
                // 'headerOptions' => ['class' => 'text-center'],
                'label' => 'Trạng thái',
            ],
            //'keywords',
            //'description:ntext',
            //'content:ntext',
            //'tag_product',
            //'tag_news',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            // 'user_id',
            // [
            //     'attribute' => 'users_add',
            //     'value'=>function($data){
            //         $user = new User();
            //         return $user->getUserById($data->users_add);
            //     },
            //     // 'headerOptions' => ['class' => 'text-center'],
            // ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
