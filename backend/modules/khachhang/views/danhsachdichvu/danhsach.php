<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\khachhang\models\KhachhangDichvuListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách dịch vụ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khachhang-dichvu-list-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="text-center">
        <?= Html::a('Nhân bản dịch vụ từ danh sách phụ tùng', ['/khachhang/danhsachdichvu/nhanban'], [
            'class' => 'btn btn-success button_luu',
            'data' => [
                'confirm' => 'Bạn có chắc muốn nhân bản dịch vụ từ phụ tùng',
                'method' => 'post',
                'params' => ['nhanban' => true]
            ]
        ]) ?>
    </p>

    
    <?php Pjax::end(); ?>
</div>
