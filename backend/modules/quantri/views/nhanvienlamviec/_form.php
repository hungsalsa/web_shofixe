<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\EmployeeCuahang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-cuahang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_employee')->textInput() ?>

    <?= $form->field($model, 'cuahang_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
