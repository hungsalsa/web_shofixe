<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'cateName',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'groupId')->textInput() ?>

    <?= $form->field($model, "parent_id",['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
        'data' => $dataCate,
        'language' => 'en',
        'options' => ['placeholder' => 'Chọn danh mục cha'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'images',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true,'id'=>'imageFile','placeholder'=>'Chọn ảnh 195x243 pixel']) ?>
    <div class="col-md-1" style="height: 80px">
        <img src="<?= (isset($model->images))? Yii::$app->request->hostInfo.'/'.$model->images:''?>" id="previewImage" alt="" style="height: 100%">
    </div>
    <?= $form->field($model, 'sort',['options'=>['class'=>'col-md-1']])->textInput(['type'=>'number']) ?>
    <?= $form->field($model, "status",['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
        'data' => [0=>' Ẩn ',1=>'Kích hoạt'],
        'language' => 'en',
        'options' => ['placeholder' => 'Chọn trạng thái'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <div class="clearfix"></div>
    
    <?= $form->field($model, 'seo_title',['options'=>['class'=>'col-md-5']])->textInput(['maxlength' => true,'id'=>'title_slug'])?>
    <?= $form->field($model, 'slug',['options'=>['class'=>'col-md-5']])->textInput(['maxlength' => true,'id'=>'slug_url'])?>

    <?= $form->field($model, 'keyword',['options'=>['class'=>'col-md-12']])->textInput(['maxlength' => true]) ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'seo_descriptions')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 4,'class'=>'content']) ?>



    <div class="form-group btn_save">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
