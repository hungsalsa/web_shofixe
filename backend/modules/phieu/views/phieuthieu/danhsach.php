<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\phieu\models\PhieuThieuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Các phiếu thiếu của cửa hàng bạn quản lý ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phieu-thieu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Thêm mới', ['create','id'=>$id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'cuahang_id',
            'ngay_giao',
            'so_phieu',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
