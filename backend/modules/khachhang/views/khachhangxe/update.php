<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhXe */

$this->title = 'Update Kh Xe: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Kh Xes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'id_KH' => $model->id_KH, 'bks' => $model->bks]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kh-xe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
