<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
if(Yii::$app->controller->action->id == 'update' && $model->phutung==1){
        $disable = true;
    }else {
       $disable = false;
    }
?>

<div class="khachhang-dichvu-list-form">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'madichvu',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true,'disabled' => $disable]) ?>
    <?= $form->field($model, 'tendv',['options'=>['class'=>'col-md-4']])->textInput(['maxlength' => true,'autofocus' => 'autofocus']) ?>

    <?= $form->field($model, 'xe_sd',['options'=>['class'=>'col-md-4']])->widget(Select2::classname(), 
        [
            'data' => $dataMotor,
            'options' => ['placeholder' => 'Chọn xe sử dụng','multiple'=>true],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]) 
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'price',['options'=>['class'=>'col-md-2']])->textInput(['type'=>'number']) ?>
    <?= $form->field($model, 'price_sale',['options'=>['class'=>'col-md-2']])->textInput(['type'=>'number']) ?>

    <?= $form->field($model, 'status',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
        'data' => [0=>'Ẩn',1=>'Kích hoạt'],
        'options' => ['placeholder' => 'Kích hoạt'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Chỉnh sửa', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
// $this->registerJsFile("@web/js/jquery.min.js");
