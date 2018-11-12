<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Models */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="models-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'title',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'title_slug'])?>

    <?= $form->field($seo, 'slug',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'slug_url'])?>


    <?php // $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active',['options' => ['class' => 'activeform col-md-2']])->widget(CheckboxX::classname(),
    [
      'initInputType' => CheckboxX::INPUT_CHECKBOX,
      'options'=>['value' => $model->active],
    ])->label(false);
    ?>

    <?= $form->field($model, 'order',['options'=>['class'=>'col-md-1']])->textInput(['type'=>'number']) ?>

    <div class="clearfix"></div>

    <?= $form->field($model, 'keyword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'short_introduction')->textarea(['rows' => 6,'class'=>'content']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
