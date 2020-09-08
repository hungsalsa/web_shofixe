<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\phieu\models\PhieuSophieuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách phiếu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-sophieu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p class="btn_save">
        <?= Html::a(' Reset ', ['index'], ['class' => 'btn btn-success']) ?>
    </p>
    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'ngay_giao',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'ngay_giao',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->ngay_giao),Yii::$app->homeUrl.'phieu/sophieu/view?id='.$data->id);
                },

            ],
            [
                'attribute' => 'cuahang_id',
                'value'=>'cuahang.name'
            ],
            'so_phieu',
            'ngay_sd',
            'ngay_tt',
            
            // 'status',
            [
                'attribute' => 'status',
                'value'=>function($data){
                    switch ($data->status) {
                        case 0:
                            return "Tồn chưa sử dụng";
                            break;
                        case 1:
                            return "Tốt đã thanh toán";
                            break;
                        case 2:
                            return "Tồn đã sử dụng";
                            break;
                        case 3:
                            return "Thanh toán tồn";
                            break;
                        default:
                            return "Phiếu hủy";
                            break;
                    }
                    
                },
                'filter' => [0 => 'Tồn chưa sử dụng', 1 => 'Tốt đã thanh toán',2=>'Tồn đã sử dụng',3=>'Thanh toán tồn',4=>'Phiếu hủy'],
                'headerOptions' => ['width' => '12%'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'visibleButtons' => [
                    'view' => Yii::$app->user->can('phieu/phieugiao/view'),
                    'update' => Yii::$app->user->can('phieu/phieugiao/update'),
                    'delete' => Yii::$app->user->can('phieu/phieugiao/delete'),
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
