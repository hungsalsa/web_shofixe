<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'image',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh cỡ 1920x464 px']) ?>
    <div class="col-md-5" style="height: 80px">
        <img src="<?= (isset($model->image))? $model->image:''?>" id="previewImage" alt="" style="height: 100%">
    </div>

    <?= $form->field($model, 'order',['options' => ['class' => 'col-md-2']])->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
        'initInputType' => CheckboxX::INPUT_CHECKBOX,
        'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'url',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alt',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6,'class' => 'content']) ?>

    <div class="clearfix"></div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
