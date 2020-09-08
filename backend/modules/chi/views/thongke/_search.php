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

<div class="chingay-search col-md-12" style="margin-top: 20px">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        'enableAjaxValidation' => false,
        'action' => ['index'],
        // 'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>



    <?=  $form->field($model, 'start_date',['options'=>['class'=>'col-md-2']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'autoclose'=>true,
            'todayHighlight' => true,
            'endDate'=> date('d-m-Y', strtotime(date("d-m-Y 0:0:0"))),
        ]
    ]); ?>

    <?=  $form->field($model, 'end_date',['options'=>['class'=>'col-md-2']])->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter birth date ...'],
        'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'autoclose'=>true, 
            'todayHighlight' => true,
            'endDate'=> date('d-m-Y', strtotime(date("d-m-Y 0:0:0"))),
        ]
    ]); ?>

    <?= $form->field($model, 'cuahang_id',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataCuahang,
        'options' => ['placeholder' => 'Enter birth date ...','multiple'=>true],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'loaichi',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataLoaichi,
        'options' => ['placeholder' => 'Enter birth date ...','multiple'=>true],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    <div class="clearfix"></div>

    <?= $form->field($model, 'bike_id',['options'=>['class'=>'col-md-3']])->widget(Select2::classname(), [
        'data' => $dataMotorbike,
        'options' => ['placeholder' => 'Enter birth date ...','multiple'=>true],
        'language' => 'en',
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    



    <div class="form-group" style="padding-top: 24px;">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
