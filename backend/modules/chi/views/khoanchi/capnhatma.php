<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\modules\chi\models\ChiKhoanchi;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\chi\models\ChiKhoanchiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách khoản chi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chi-khoanchi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
    <form method="get" action="" class="form-inline">
        <div class="form-group">
            <label>Nhân bản vật tư tiêu hao</label>
            <input class="form-control btn btn-primary" type="submit" name="code" value="vattutieuhao"><br>
        </div>
        <div class="form-group">
            <label>Nhân bản phụ tùng lẻ + PT toa</label>
            <input class="form-control btn btn-success" type="submit" name="code" value="nhanbansp"><br>
        </div>
        <div class="form-group">
            <label>Nhân bản từ dụng cụ thiết bị</label>
            <input class="form-control btn btn-info" type="submit" name="code" value="dungcutb">
        </div>
    </form>
    </p>
    <p class="btn_save">
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success btn_luu']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary' => "Từ {begin} -> {end} trong tổng {totalCount} khoản chi",
        'tableOptions' => ['class' => 'table table-bordered table-hover'],
        'rowOptions' => function ($model, $key, $index, $grid) {
            return [
                'style' => "cursor: pointer",
                'id' => $model['id'], 
                'onclick' => 'location.href="'
                . Yii::$app->urlManager->createUrl('chi/khoanchi/view')
                . '?id="+(this.id);',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'makhoanchi',
            'name',
            [
                'attribute'=>'donvitinh',
                'value'=>'dvt.unitName',
            ],
            'status',
            [
                'attribute'=>'loaichi_id',
                'value'=>'loaichi.name',
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i->d-m-Y']
            ],
            [
                'attribute'=>'user_add',
                'value'=>'user.username'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
