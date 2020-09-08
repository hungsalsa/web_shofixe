<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\doanhthu\models\DoanhthuKhacSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Khoản thu khác : '.$doanhthuInfo['ngay'].' cửa hàng '.$doanhthuInfo['ten_cua_hang'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doanhthu-khac-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Doanhthu Khac', ['create', 'id'=>$doanhthuInfo['id']], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'doanhthu_id',
            'name',
            'money',
            'note:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
