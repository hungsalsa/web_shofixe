<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuThieu */

$this->title = 'Update Phieu Thieu: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Phieu Thieus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="phieu-thieu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'daygiao' => $daygiao,
        'sophieu' => $sophieu,
        'dataCuahang' => $dataCuahang,
    ]) ?>

</div>
