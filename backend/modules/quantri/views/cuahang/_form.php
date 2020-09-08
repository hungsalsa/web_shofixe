<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\doanhthu\models\CuaHang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cua-hang-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'address',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone',['options' => ['class' => 'col-md-2']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'status_active col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
