<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Employee */

$this->title = 'Thêm mới nhân viên';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'location' => $location,
        'dataCuahang' => $dataCuahang,
    ]) ?>

</div>
