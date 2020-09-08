<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductTransferDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-transfer-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_transfer')->textInput() ?>

    <?= $form->field($model, 'pro_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
