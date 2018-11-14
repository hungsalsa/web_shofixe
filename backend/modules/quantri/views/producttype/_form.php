<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\ProductType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'typeName',['options' => ['class' => 'col-md-6']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
                        [
                            'initInputType' => CheckboxX::INPUT_CHECKBOX,
                            'options'=>['value' => $model->status],
                        ])->label(false);
                        ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success','style'=>'margin-top: 21px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
