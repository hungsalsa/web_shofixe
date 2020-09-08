<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="employee-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name',['options'=>['class'=>'col-md-6']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone',['options'=>['class'=>'col-md-4']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status',['options' => ['class' => 'btn_active col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <?= $form->field($model, 'location',['options'=>['class'=>'col-md-4']])->widget(Select2::classname(), [
        'data' => $location,
        'options' => ['placeholder' => '-- Chọn vị trí --'],
        'pluginOptions' => [
            'allowClear' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ]) ?>
    <?= $form->field($model, 'cua_hang',['options'=>['class'=>'col-md-6']])->widget(Select2::classname(), [
        'data' => $dataCuahang,
        'options' => ['placeholder' => '-- Làm tại --','multiple'=>true],
        'pluginOptions' => [
            'allowClear' => true,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10
        ],
    ]) ?>
    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Chỉnh sửa', ['class' => 'btn btn-primary btn_luu']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>