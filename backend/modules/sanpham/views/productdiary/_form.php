<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductDiary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-diary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'day')->textInput() ?>

    <?= $form->field($model, 'pro_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuahang_id')->textInput() ?>

    <?= $form->field($model, 'store_number')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_ad')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
