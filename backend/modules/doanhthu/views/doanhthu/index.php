<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\doanhthu\models\DoanhthuKhac;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\doanhthu\models\DoanhThuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doanh Thus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doanh-thu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Doanh Thu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'ngay',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->ngay),Yii::$app->homeUrl.'doanhthu/doanhthu/view?id='.$data->id);
                },
            ],
            // 'cua_hang',
            [
                'attribute' => 'cua_hang',
                'value'=>'cuahang.name',
            ],
            [
                'attribute' =>'giao_sang',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'tong_doanh_thu_phieu',
                'format'=>['decimal',0],
            ],
            // 'tt_ck',
            // 'tt_the',
            //'tt_tien_mat',
            //'tong_doanh_thu_phieu',
            //'doanh_thu_thuc',
            //'thu_khac',
            //'tien_chi',
            //'tien_hom',
            //'tien_le',
            [
                'attribute' =>'tien_chi',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'tong_tien_mat',
                'format'=>['decimal',0],
            ],
            [
                'attribute' =>'chenh_lech',
                'format'=>['decimal',0],
            ],
            //'ketoan',
            //'nguoi_ky',
            //'note:ntext',
            
            //'status',
            //'created_at',
            //'updated_at',
            //'user_add',
            [
                'attribute' =>'thu_khac',
                'format'=>'html',
                'value'=>function($data){
                    // $thu  = new DoanhthuKhac();
                    // $money = $thu->getAll_money_ByDoanhthu($data->id);
                    // return $money;
                    return Html::a(number_format($data->thu_khac,0,'.',','), ['doanhthukhac/', 'id'=>$data->id], ['title' => 'Tổng doanh thu', 'target' => '_blank', 'data' => ['pjax' => 0]] );
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
