<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\number\NumberControl;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\VattuTh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vattu-th-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true,'enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'machi',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuahang_id',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
    [
        'data' => $dataCuahang,
        'options' => ['placeholder' => 'Chon một'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) 
    ?>
    <?= $form->field($model, 'dvt',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
    [
        'data' => $dataDonvitinh,
        'options' => ['placeholder' => 'Chon một'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) 
    ?>
    <?= $form->field($model, 'sl_dk',['options'=>['class'=>'col-md-2']])->textInput() ?>
    <?= $form->field($model, 'price',['options'=>['class'=>'col-md-1']])->widget(NumberControl::classname(), [
        'maskedInputOptions' => [
                // 'prefix' => 'vnđ ',
            'suffix' => '',
            'allowMinus' => false,
            'groupSeparator' => '.',
            'radixPoint' => ','
        ],
        'displayOptions' => ['class' => 'form-control kv-monospace'],
        'saveInputContainer' => ['class' => 'kv-saved-cont']
    ]);
    ?>

    <?= $form->field($model, 'status',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
    [
        'data' => [0 =>'Ẩn',1=>'Kích hoạt'],
        'options' => ['placeholder' => 'Chon một'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) 
    ?>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
