<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách Account admin';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if (Yii::$app->user->can('user/signup')): ?>
        
    <p class="btn_save">
        <?= Html::a('Thêm mới', ['signup'], ['class' => 'btn btn-success btn_luu']) ?>
    </p>
    <?php endif ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Từ {begin} -> {end} trong tổng {totalCount} Account",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('user/update')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'username',
            'fullname',
            // 'auth_key',
            // 'password_hash',
            //'password_reset_token',
            //'email:email',
            //'image',
            //'phone',
            //'gender',
            //'manager',
            //'status',
            //'created_at',
            //'updated_at',
            [
                'attribute'=>'status',
                'value'=>function($data){
                    $status = [0=>' Ẩn ',10=>'Kích hoạt'];
                    return $status[$data->status];
                }
            ],
            
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute'=>'permission',
                'value'=>function($data){
                    pr($data);
                    $result = ['admin'=>'Quản trị','manager'=>'Biên tập viên','author'=>'Cộng tác viên'];
                    // dbg($data->quyenhan->item_name);
                    return (isset($data->quyenhan->item_name)) ? $result[$data->quyenhan->item_name] : 'Chưa có';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['style' => 'color:#337ab7;width: 9%'],
                'contentOptions' => ['class' => 'actionColumn text-center','style' => 'font-size:18px'],
                'template' => '{update}  {delete}  {resetpassword}',
                'visibleButtons' => [
                    'update' => Yii::$app->user->can('user/update'),
                    'delete' => Yii::$app->user->can('user/delete')
                ],

                'buttons'  => [
                    'resetpassword'   => function ($url, $model) {//dbg(Yii::$app->user->id);
                        $url = Url::to(['user/resetpassword', 'id' => $model->id]);
                        return ($model->id==1 || $model->id==Yii::$app->user->id)?'': Html::a('<span class="fa fa-key"></span>', $url, ['title' => 'Reset Password','style'=>'margin-left:3px;font-size:23px;font-weight:bold;']);
                    },
                ]

            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
