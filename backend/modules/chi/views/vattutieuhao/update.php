<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\VattuTh */

$this->title = 'Update Vattu Th: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Vattu Ths', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vattu-th-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataDonvitinh' => $dataDonvitinh,
        'dataCuahang' => $dataCuahang,
    ]) ?>

</div>
