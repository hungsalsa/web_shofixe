<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\quantri\models\EmployeeCuahangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employee Cuahangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-cuahang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'cuahang_id',
                'value' => 'cuahang.name'
            ],
            [
                'attribute' => 'id_employee',
                'value' => 'nhanvien.name'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
