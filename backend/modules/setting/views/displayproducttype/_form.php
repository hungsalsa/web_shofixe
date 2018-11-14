<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\SettingDisplayProductType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-display-product-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_home_id')->textInput() ?>

    <?= $form->field($model, 'product_type_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
