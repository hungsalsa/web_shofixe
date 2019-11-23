<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\SettingModules */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-modules-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-3']])->textInput() ?>

    <!-- <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'cate_id',['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
            'data' => $dataLinkCat,
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Menu ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    
    <?= $form->field($model, 'positions',['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
            'data' => [0 => ' --Trái-- ',1 =>' --Phải-- '],
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Menu ...','multiple'=>true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>


    <?= $form->field($model, 'sort',['options' => ['class' => 'col-md-2']])->textInput() ?>
    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
        'initInputType' => CheckboxX::INPUT_CHECKBOX,
        'options'=>['value' => $model->status],
        ])->label(false);
    ?>

    <div class="clearfix"></div>
    <?= $form->field($model, 'content')->textarea(['rows' => 6,'class'=>'content']) ?>


    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
