<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use backend\modules\phieu\models\PhieuSophieu;
/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuThieu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phieu-thieu-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    

    <?php
    echo $form->field($model, "ngay_giao",['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
        'data' => $daygiao,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Day','disabled' => 'true'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, 'ngay_giao')->hiddenInput()->label(false); ?>
    <?php
    echo $form->field($model, "cuahang_id",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataCuahang,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a Day','disabled' => 'true'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, 'cuahang_id')->hiddenInput()->label(false); ?>

    <?php
    echo $form->field($model, "so_phieu",['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
    	'data' => $sophieu,
    	'language' => 'en',
    	'options' => ['placeholder' => 'Chọn số phiếu thiếu','multiple'=>true],
    	'pluginOptions' => [
    		'allowClear' => true
    	],
    ]);
    ?>


    <?= $form->field($model, 'status',['options' => ['class' => 'status_active col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
