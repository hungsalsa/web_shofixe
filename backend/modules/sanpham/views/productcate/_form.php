<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\sanpham\models\ProductCate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-cate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cateName',['options' => ['class' => 'col-md-4']])->textInput(['maxlength' => true,'autofocus' => 'autofocus']) ?>

    <?= $form->field($model, "parent_id",['options'=>['class'=>'col-md-4']])->widget(Select2::classname(), [
        'data' => $dataCate,
        'language' => 'en',
        'options' => ['placeholder' => 'Pilih Kelas'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?= $form->field($model, 'status',['options' => ['class' => 'btn_active col-md-2']])->widget(CheckboxX::classname(),
        [
            'initInputType' => CheckboxX::INPUT_CHECKBOX,
            'options'=>['value' => $model->status],
        ])->label(false);
    ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>


    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới':'Cập nhật', ['class' => 'btn btn-success btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
