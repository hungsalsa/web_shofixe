<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\quantri\models\CuaHang;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới', ['signup'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'username',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'username',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->username),Yii::$app->homeUrl.'user/update?id='.$data->id);
                },
            ],
            'fullname',
            [
                'attribute' => 'image',
                'format' => 'html',    
                'value' => function ($data) {
                    return Html::img($data['image'],
                        ['width' => '70px']);
                },
            ],
            'manager',
            // 'auth_key',
            // 'password_hash',
            //'password_reset_token',
            //'email:email',
            //'cuahang_id',
            //'status',
            'editquantity',
            [
                'attribute' => 'cuahang_id',
                'value' => function($data){
                    $cuahang = new CuaHang();
                    if($data->cuahang_id != ''){
                    return $cuahang->getNameByArray(json_decode($data->cuahang_id));
                }else {
                    return '';
                }
                },
            ],
            [
                'attribute' => 'view_cuahang',
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d-m-Y']
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
