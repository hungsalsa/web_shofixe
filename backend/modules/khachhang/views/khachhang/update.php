<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhachHang */

$this->title = 'Chỉnh sửa: '.$model->name.' số đt :'.$model->phone;
$this->params['breadcrumbs'][] = ['label' => 'Khach Hangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'idKH' => $model->idKH, 'phone' => $model->phone]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="khach-hang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataMotor' => $dataMotor,
        'modelsKHXe' => $modelsKHXe,
    ]) ?>

</div>
