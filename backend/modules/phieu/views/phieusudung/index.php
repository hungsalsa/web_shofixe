<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\phieu\models\PhieuSudungSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách sử dụng phiếu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-sudung-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
        <h2 class="pull-right">Tổng số : <?=$dataProvider->getTotalCount(); ?> Phiếu</h2>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'cuahang_id',
                'value'=>'cuahang.name'
            ],
            'ngay_sd',
            'so_phieu_dau',
            'so_phieu_cuoi',
            'phieu_ton',
            'phieu_ton_tt',
            'phieu_huy',
            //'sl_phieu_tot',
            //'ke_toan',
            //'quan_ly',
            //'note:ntext',
            //'status',
            //'created_at',
            //'updated_at',
            //'user_create',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
