<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhachhangDichvuList */

$this->title = 'Thêm mới dịch vụ';
$this->params['breadcrumbs'][] = ['label' => 'Khachhang Dichvu Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="khachhang-dichvu-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataMotor' => $dataMotor,
    ]) ?>

</div>
