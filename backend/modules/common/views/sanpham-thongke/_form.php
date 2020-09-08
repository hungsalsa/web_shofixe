<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\common\models\SanphamThongke */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sanpham-thongke-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'masp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuahang_id')->textInput() ?>

    <?= $form->field($model, 'proName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sldauky')->textInput() ?>

    <?= $form->field($model, 'tiendauky')->textInput() ?>

    <?= $form->field($model, 'slnhap')->textInput() ?>

    <?= $form->field($model, 'tiennhap')->textInput() ?>

    <?= $form->field($model, 'slxuat')->textInput() ?>

    <?= $form->field($model, 'tienxuat')->textInput() ?>

    <?= $form->field($model, 'slxuatnb')->textInput() ?>

    <?= $form->field($model, 'slnhapnb')->textInput() ?>

    <?= $form->field($model, 'slton')->textInput() ?>

    <?= $form->field($model, 'tienton')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
