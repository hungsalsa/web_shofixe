<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\quantri\models\Motorbike */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="motorbike-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bikeName',['options'=>['class'=>'col-md-6']])->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'hangxe_id',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
        'data' => $dataHangxe,
        'options' => ['placeholder' => 'Xe của hãng'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    <?= $form->field($model, 'status',['options'=>['class'=>'col-md-2']])->widget(Select2::classname(), [
        'data' => [0 =>'Ẩn',1=>'Kích hoạt'],
        'options' => ['placeholder' => 'Cửa hàng làm'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
	<div class="clearfix"></div>
    <?= $form->field($model, 'note')->textarea(['rows' => 3]) ?>


    <div class="form-group btn_save">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Chỉnh sửa', ['class' => 'btn btn-primary btn_luu']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
