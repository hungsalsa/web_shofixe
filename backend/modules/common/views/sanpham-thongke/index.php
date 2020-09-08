<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\common\models\SanphamThongkeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sanpham Thongkes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sanpham-thongke-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sanpham Thongke', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'masp',
            'cuahang_id',
            'proName',
            'cate_id',
            'sldauky',
            'tiendauky',
            'slnhap',
            'tiennhap',
            'slxuat',
            'tienxuat',
            'slxuatnb',
            'slnhapnb',
            'slton',
            'tienton',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
