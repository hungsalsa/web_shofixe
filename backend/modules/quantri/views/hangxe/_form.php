<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Hangxe */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hangxe-form">

    <?php $form = ActiveForm::begin(['enableClientValidation' => true, 'enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'name',['options'=>['class'=>'col-md-5']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note',['options'=>['class'=>'col-md-5']])->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord? 'Thêm mới': 'Update', ['class' => 'btn btn-success btn_active']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
