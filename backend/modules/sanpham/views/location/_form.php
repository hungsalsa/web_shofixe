<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\Location */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, "cuahang_id",['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
        'data' => $cuahang,
        'language' => 'en',
        'options' => ['placeholder' => 'Cửa hàng'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, "status",['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
        'data' => [1=>'Kích hoạt',0=>'Ẩn'],
        'language' => 'en',
        'options' => ['placeholder' => 'Select a..'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'note',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn_active']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
