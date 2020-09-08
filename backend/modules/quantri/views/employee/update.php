<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Employee */

$this->title = 'Chỉnh sửa nhân viên : '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'location' => $location,
        'dataCuahang' => $dataCuahang,
    ]) ?>

</div>
