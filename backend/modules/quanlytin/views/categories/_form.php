<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\checkbox\CheckboxX;
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'cateName',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'title_slug']) ?>

    <?= $form->field($model, 'slug',['options'=>['class'=>'col-md-5']])->textInput(['maxlength' => true,'id'=>'slug_url'])?>
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

    
    <?= $form->field($model, 'sort',['options'=>['class'=>'col-md-1']])->textInput() ?>
    
    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
            'autoLabel' => true
        ])->label(false);
        ?>
    <div class="clearfix"></div>
    
    <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true])?>

    <?= $form->field($model, 'seo_descriptions')->textarea(['rows' => 4]) ?>
    <?= $form->field($model, 'keyword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 4,'class'=>'content']) ?>



    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['/quanlytin/categories'], ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
