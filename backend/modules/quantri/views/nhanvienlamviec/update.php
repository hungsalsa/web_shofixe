<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\EmployeeCuahang */

$this->title = 'Update Employee Cuahang: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Employee Cuahangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employee-cuahang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
