<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuSudung */

$this->title = 'Update Phieu Sudung: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Phieu Sudungs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="phieu-sudung-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataCuahang' => $dataCuahang,
        'dataEmployee' => $dataEmployee,
        'datasophieu' => $datasophieu,
    ]) ?>

</div>
