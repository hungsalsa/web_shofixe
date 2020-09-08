<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'supName',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'btn_active col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' :'Chỉnh sửa', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
