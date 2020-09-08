<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhachHang */

$this->title = 'Thêm mới khách hàng';
$this->params['breadcrumbs'][] = ['label' => 'Khach Hangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khach-hang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataMotor' => $dataMotor,
        'modelsKHXe' => $modelsKHXe,
    ]) ?>

</div>
