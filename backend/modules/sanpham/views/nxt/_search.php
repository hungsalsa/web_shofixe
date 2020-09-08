<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
// use kartikorm\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\modules\chi\models\ChingaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chingay-search col-md-12">
            <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'action' => ['index'],
        // 'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

        <?= $form->field($model, 'cuahang_id',['options'=>['class'=>'col-md-4']])->widget(Select2::classname(), [
        'data' => $dataCuahang,
        'options' => ['placeholder' => 'Enter birth date ...'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?> 
        <?= $form->field($model, 'cate_id',['options'=>['class'=>'col-md-4']])->widget(Select2::classname(), [
        'data' => $dataCate,
        'options' => ['placeholder' => 'Enter birth date ...','multiple'=>true],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
     
        <?= $form->field($model, 'proId',['options'=>['class'=>'col-md-4']])->widget(Select2::classname(), [
        'data' => $listProduct,
        'options' => ['placeholder' => 'Enter birth date ...'],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>



    <div class="form-group" style="padding-top: 18px;">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary button_luu']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-success button_luu']) ?>
        <?= Html::button('In danh sách', ['class' => 'btn btn-info button_luu','onclick'=>'window.print();']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    

</div>
