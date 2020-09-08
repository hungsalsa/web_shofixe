<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\quantri\models\CuaHang;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách nhân viên';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới nhân viên', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Nhân viên từ {begin} -> {end} trong tổng {totalCount} nhân viên",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('quantri/employee/view')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'name',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'name',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode($data->name),Yii::$app->homeUrl.'chi/employee/update?id='.$data->id);
                },
            ],
            [
                'attribute' => 'cua_hang',
                'value' => function($data){
                    $cuahang = new CuaHang();
                    return $cuahang->getNameByArray(json_decode($data->cua_hang));
                },
            ],
            // 'phone',
            'location',
            'status',
            //'created_at',
            //'updated_at',
            //'user_add',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
