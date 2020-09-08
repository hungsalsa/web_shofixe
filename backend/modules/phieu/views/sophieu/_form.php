<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuSophieu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phieu-sophieu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ngay_giao')->textInput() ?>

    <?= $form->field($model, 'cuahang_id')->textInput() ?>

    <?= $form->field($model, 'ngay_sd')->textInput() ?>

    <?= $form->field($model, 'ngay_tt')->textInput() ?>

    <?= $form->field($model, 'so_phieu')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
