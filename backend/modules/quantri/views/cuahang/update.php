<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\CuaHang */

$this->title = 'Update Cua Hang: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Cua Hangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cua-hang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
