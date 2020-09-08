<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
 $user = Yii::$app->user->identity; 
 if($user->id == 1){
    $disable = false;
 }else {
     $disable = true;
 }
?>


<div class="user-form">
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($model, 'id',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'disabled' => $disable]) ?>
    <?= $form->field($model, 'username',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'disabled' => $disable]) ?>

    <?= $form->field($model, 'fullname',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true]) ?>
    

    <div class="clearfix"></div>
    <?= $form->field($model, 'image',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh 30x30px']) ?>
    
                
    <?= $form->field($model, "view_cuahang",['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => [0 =>'-Không-', 1 => 'Là người xem'],
        'language' => 'en',
        'options' => ['placeholder' => 'Chọn 1'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, "manager",['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => [0 =>'-Không-', 1 => 'Là Quản lý'],
        'language' => 'en',
        'options' => ['placeholder' => 'Chọn 1'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    

    <?= $form->field($model, "permission",['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => $authItems,
        'language' => 'en',
        'options' => ['placeholder' => 'Chọn 1'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'status',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
        'data' => [0 => ' Hidden ',10 => ' Active '],
        'options' => ['placeholder' => '-- Kick hoat --'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'cuahang_id',['options'=>['class'=>'col-md-8']])->widget(Select2::classname(), [
        'data' => $dataCuahang,
        'options' => ['placeholder' => '-- Làm tại --','multiple'=>true],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="clearfix"></div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>



