<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductMotorbike */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-motorbike-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pro_id')->textInput() ?>

    <?= $form->field($model, 'motor_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
