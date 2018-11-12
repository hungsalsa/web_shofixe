<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\SettingCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group pull-right">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Hủy', ['index'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="clearfix"></div>
    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id',['options' => ['class' => 'col-md-4']])->widget(Select2::classname(), [
            'data' => $dataSetCate,
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Menu ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'link_cate',['options' => ['class' => 'col-md-4']])->widget(Select2::classname(), [
            'data' => $dataLinkCat,
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Menu ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    <div class="clearfix"></div>
    <?php // $form->field($model, 'icon',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageicon','placeholder'=>'Click chọn ảnh']) ?>
    
    

    <?= $form->field($model, 'order',['options' => ['class' => 'col-md-2']])->textInput(['type'=>'number']) ?>
    
    <?= $form->field($model, 'title',['options' => ['class' => 'col-md-9']])->textInput(['maxlength' => true]) ?>

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
