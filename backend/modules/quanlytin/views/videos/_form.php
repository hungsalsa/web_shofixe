<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\quanlytin\models\Videos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="videos-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'name',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'title_slug']) ?>
    <?= $form->field($model, "category_id",['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
        'data' => $dataCate,
        'language' => 'en',
        'options' => ['placeholder' => 'Chọn danh mục cha'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, 'link',['options'=>['class'=>'col-md-5']])->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'showtab',['options' => ['class' => 'has-success activeform col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->showtab],
            'autoLabel' => false
        ])->label(false);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'sort',['options'=>['class'=>'col-md-2']])->textInput(['maxlength' => true])?>


    <?= $form->field($model, 'seo_title',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true])?>
    <?= $form->field($model, 'slug',['options'=>['class'=>'col-md-3']])->textInput(['maxlength' => true,'id'=>'slug_url'])?>


    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
            'autoLabel' => true
        ])->label(false);
    ?>
    <div class="clearfix"></div>
    <?= $form->field($model, 'seo_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6,'class'=>'content']) ?>

    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['/quanlytin/videos'], ['class'=>'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
