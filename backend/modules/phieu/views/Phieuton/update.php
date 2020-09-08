<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuTon */

$this->title = 'Update Phieu Ton: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Phieu Tons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="phieu-ton-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
