<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\EmployeeCuahang */

$this->title = 'Create Employee Cuahang';
$this->params['breadcrumbs'][] = ['label' => 'Employee Cuahangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-cuahang-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
