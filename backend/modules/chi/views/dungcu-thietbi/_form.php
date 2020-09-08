<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\number\NumberControl;
?>

<div class="dungcu-thietbi-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true,'enableAjaxValidation' => true]); ?>
    <?= $form->field($model, 'madungcu',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name',['options'=>['class'=>'col-md-5']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'donvitinh',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), 
    [
        'data' => $dataDonvitinh,
        'options' => ['placeholder' => 'Chon một'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) 
    ?>
    <?= $form->field($model, 'quantity',['options'=>['class'=>'col-md-1']])->textInput() ?>
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

    <?= $form->field($model, 'note',['options'=>['class'=>'col-md-8']])->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Chỉnh sửa', ['class' => 'btn btn-success btn_active']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
