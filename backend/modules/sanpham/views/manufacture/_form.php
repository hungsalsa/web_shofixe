<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Manufacture */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manufacture-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'manuName',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone',['options' => ['class' => 'col-md-2']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'btn_active col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'note')->textarea(['rows' => 6,'class'=>'content']) ?>

    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Cập nhật', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
