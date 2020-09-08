<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Unit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'unitName',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'btn_active col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
