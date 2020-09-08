<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\khachhang\models\KhChitietDv */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kh-chitiet-dv-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_dv')->textInput() ?>

    <?= $form->field($model, 'id_Pro_dv')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
