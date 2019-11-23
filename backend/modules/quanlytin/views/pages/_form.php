<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(
        [
            'enableAjaxValidation' => true,
        ]
    ); ?>

    <?= $form->field($model, 'name',['options'=>['class'=>'col-md-4']])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'title_slug'])?>
    <?= $form->field($model, 'slug',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'slug_url'])?>


    <?php // $form->field($seo, 'slug',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'slug_url']) ?>


    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
        ?>
        <div class="clearfix"></div>
        <?php
     // $form->field($model, 'tag_product')->widget(Select2::classname(), [
     //        'data' => $dataProduct,
     //        'language' => 'vi',
     //        'options' => ['placeholder' => 'Select a product ...', 'multiple' => true],
     //        'pluginOptions' => [
     //            'allowClear' => true
     //        ],
     //    ]);
        ?>

        <?= $form->field($model, 'tag_news')->widget(Select2::classname(), [
            'data' => $dataNews,
            'language' => 'vi',
            'options' => ['placeholder' => 'Select a product ...', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

        <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'short_introduction')->textarea(['rows' => 6,'class' => 'content']) ?>

        <?= $form->field($model, 'content')->textarea(['rows' => 6,'class' => 'content']) ?>


        <div class="form-group btn_save">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Hủy bỏ', ['index'], ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
