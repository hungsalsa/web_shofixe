<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\khachhang\models\KhChitietDvSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kh Chitiet Dvs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kh-chitiet-dv-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kh Chitiet Dv', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_dv',
            'id_Pro_dv',
            'price',
            'quantity',
            'suffixes',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
