<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuGiao */

$this->title = 'Update Phieu Giao: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Phieu Giaos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="phieu-giao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataEmployee' => $dataEmployee,
        'dataCuahang' => $dataCuahang,
    ]) ?>

</div>
