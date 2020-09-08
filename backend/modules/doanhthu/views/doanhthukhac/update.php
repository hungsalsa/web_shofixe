<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\DoanhthuKhac */

$this->title = 'Update Doanhthu Khac: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Doanhthu Khacs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="doanhthu-khac-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
