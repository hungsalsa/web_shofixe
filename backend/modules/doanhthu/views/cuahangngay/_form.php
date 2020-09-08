<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\CuahangNgay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuahang-ngay-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ngay')->textInput() ?>

    <?= $form->field($model, 'cuahang_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
