<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\phieu\models\PhieuTon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phieu-ton-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'so_phieu_ton')->textInput() ?>

    <?= $form->field($model, 'ngay_sd')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
