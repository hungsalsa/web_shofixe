<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhXe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kh-xe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_KH')->textInput() ?>

    <?= $form->field($model, 'xe')->textInput() ?>

    <?= $form->field($model, 'bks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'nguoi_sd')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
