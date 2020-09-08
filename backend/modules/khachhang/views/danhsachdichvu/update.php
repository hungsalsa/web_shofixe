<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhachhangDichvuList */

$this->title = 'Chỉnh sửa dịch vụ';
$this->params['breadcrumbs'][] = ['label' => 'Khachhang Dichvu Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="khachhang-dichvu-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataMotor' => $dataMotor,
    ]) ?>

</div>
