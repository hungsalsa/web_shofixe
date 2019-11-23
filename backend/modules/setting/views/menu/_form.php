<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\setting\models\Menus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menus-form">

    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true]); ?>
    

    <?= $form->field($model, 'name',['options' => ['class' => 'col-md-3']])->textInput(['maxlength' => true]) ?>

    
    <?= $form->field($model, 'link_cate',['options' => ['class' => 'col-md-2']])->widget(Select2::classname(), [
            'data' => $dataLinkCat,
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Menu ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>
    
    <?= $form->field($model, 'parent_id',['options' => ['class' => 'col-md-3']])->widget(Select2::classname(), [
            'data' => $dataMenus,
            'language' => 'en',
            'options' => ['placeholder' => 'Select a Menu ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>


    <?= $form->field($model, 'order',['options' => ['class' => 'col-md-2']])->textInput(['placeholder' => '990']) ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'activeform col-md-1']])->widget(CheckboxX::classname(),
        [
        'initInputType' => CheckboxX::INPUT_CHECKBOX,
        'options'=>['value' => $model->status],
        ])->label(false);
    ?>

    
    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới': 'Cập nhật', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
