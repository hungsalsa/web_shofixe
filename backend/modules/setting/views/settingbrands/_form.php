<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\SettingBrands */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-brands-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alt',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($model, 'image',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh 121x45 px']) ?>
    <div class="col-md-4" style="height: 80px">
        <img src="<?= (isset($model->image))? Yii::$app->request->hostInfo.'/'.$model->image:''?>" id="previewImage" alt="" style="height: 100%">
    </div>

    <?= $form->field($model, 'order',['options' => ['class' => 'col-md-3']])->textInput(['type'=>'number']) ?>
    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
        'initInputType' => CheckboxX::INPUT_CHECKBOX,
        'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
