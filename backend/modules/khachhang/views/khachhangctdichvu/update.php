<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhChitietDv */

$this->title = 'Update Kh Chitiet Dv: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Kh Chitiet Dvs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kh-chitiet-dv-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
